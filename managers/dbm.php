<?php
#region Database Manager setup
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

session_start();
ob_start();

$inactive = 10 * 60;
if (isset($_SESSION["user"]) && isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_unset();
        header("refresh:0");
        exit();
    }
}
$_SESSION['timeout'] = time();


// Customer action status
$status =   ["waiting", "in progress", "completed", "cancelled"];
$statusImages =   [
    "https://cdn-icons-png.flaticon.com/512/850/850960.png",         // "waiting",       
    "https://cdn-icons-png.flaticon.com/512/4795/4795155.png",       // "in progress",   
    "https://cdn-icons-png.flaticon.com/512/6784/6784655.png",       // "completed",     
    "https://cdn-icons-png.flaticon.com/512/2001/2001386.png"          // "cancelled"      
];
$statusColor = ["#e0501b", "#abc720", "#20c723", "#353535"];



function runQuery($qstr, $params = [], $single = true, $returnId = false)
{
    $con = mysqli_connect("localhost", "root", "", "LastAction");
    $con->set_charset("utf8");
    if ($con->connect_error) {
        die("Connection failed" . $con->connect_error);
    }
    try {
        if (!empty($params)) {
            $stmt = $con->prepare($qstr);
            if ($stmt === false) {
                return;
            }
            $types = '';
            $bindParams = [];
            foreach ($params as $param) {
                if (is_int($param)) {
                    $types .= 'i';
                } elseif (is_float($param)) {
                    $types .= 'd';
                } elseif (is_string($param)) {
                    $types .= 's';
                } else {
                    $types .= 's';
                }
                $bindParams[] = $param;
            }
            if (!empty($bindParams)) {
                $stmt->bind_param($types, ...$bindParams);
            }
            $stmt->execute();

            if ($returnId) {
                return $stmt->insert_id;
            }

            $result = $stmt->get_result();
            if (!$result) {
                return;
            }
            $data = [];
            if ($single) {
                $data = $result->fetch_assoc();
            } else {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
            $stmt->close();
            return $data;
        } else {
            $result = mysqli_query($con, $qstr);
            if (!$result) {
                return;
            }
            $data = [];
            if ($single) {
                $data = mysqli_fetch_assoc($result);
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
            mysqli_free_result($result);
            return $data;
        }
    } catch (\Throwable $th) {
        return;
    } finally {
        $con->close();
    }
}
#endregion


#region User


function UserExistsByEmail($email)
{
    return runQuery("select true from users where email=?", [$email]) ? true : false;
}

function GetUserByEmailPassword($email, $password)
{
    return runQuery("select * from users where email=? and password=?", [$email, $password]);
}

function LoginUser($email, $password)
{
    $q = runQuery("select id from users where email=? and password=?", [$email, $password]);
    $_SESSION["user"] = $q["id"];
}

function RegisterUser($name, $email, $password)
{
    $q = runQuery("insert into users (name,email,password) values (?,?,?)", [$name, $email, $password], returnId: true);
    $_SESSION["user"] = $q;
}

function LogoutUser()
{
    unset($_SESSION["user"]);
    header("location:./");
}

function GetUserById($id)
{
    return runQuery("select id,name,email,active from users where id=?", [$id]);
}


#endregion


#region News

function GetNews()
{
    return runQuery("select * from news where display=1", single: false);
}

#endregion


#region FAQ

function GetFAQ()
{
    return runQuery("select * from faq where display=1", single: false);
}

function AddFAQ($from, $question)
{
    return runQuery("insert into faq (`from`,`question`) values (?,?)", [$from, $question]);
}

#endregion


#region Stores

function CreateStore($name, $about, $image = null)
{
    if (isset($image)) {
        $image = file_get_contents($image);
    }
    runQuery("insert into stores (owner,name,about,logo) values (?,?,?,?)", [$_SESSION["user"], $name, $about, $image]);
}

function OpenStore()
{
    runQuery("update stores set open=1 where owner=?", [$_SESSION["user"]]);
}

function CloseStore()
{
    runQuery("update stores set open=0 where owner=?", [$_SESSION["user"]]);
}


function GetStoreByUserId($id)
{
    return runQuery("select * from stores where owner = ?", [$id]);
}

function GetStoreByToken($token)
{
    return runQuery("select * from stores where token = ?", [$token]);
}

function UpdateStoreName($name)
{
    runQuery("update stores set name = ? where owner = ?", [$name, $_SESSION["user"]]);
}

function UpdateStoreAbout($about)
{
    runQuery("update stores set about = ? where owner = ?", [$about, $_SESSION["user"]]);
}

function UpdateStoreLogo($image)
{
    if (isset($image)) {
        $image = file_get_contents($image);
    }
    runQuery("update stores set logo = ? where owner = ?", [$image, $_SESSION["user"]]);
}
/**
 * returns link of store preview link if its exists 
 */
function StorePreviewLink()
{
    return runQuery("select token from stores where owner = ?", [$_SESSION["user"]]);
}

// Store Carousel

function GetStoreCarousel($storeId)
{
    return runQuery("select * from store_carousel where store = ?", [$storeId], single: false);
}

function GetStoreCarouselCount($storeId)
{
    return runQuery("select count(*) as count from store_carousel where store = ?", [$storeId]);
}

function RemoveStoreCarousel($carouselId)
{
    runQuery("delete from store_carousel where id = ?", [$carouselId]);
}

function AddStoreCarousel($storeId, $image, $title, $content)
{
    $image = file_get_contents($image);
    runQuery(
        "insert into store_carousel (store,image,title,content) values(?,?,?,?)",
        [$storeId, $image, $title, $content]
    );
    header("refresh:2");
}

#endregion


#region Customers

function AddCustomer($name, $storeId, $issue, $contact)
{
    runQuery("insert into customers (name,store,issue,contact) values (?,?,?,?)", [$name, $storeId, $issue, $contact]);
}

function GetCustomers()
{
    return runQuery("select * from customers as c where c.store=(select id from stores where owner=?) order by active desc,status asc", [$_SESSION["user"]], single: false);
}


function ChangeCustomerActive($customer, $to)
{
    runQuery("update customers set active=? where id=? and store=(select id from stores where owner =?)", [$to, $customer, $_SESSION["user"]]);
}

function ChangeCustomerStatus($customer, $to)
{
    runQuery("update customers set status=? where id=? and store=(select id from stores where owner =?)", [$to, $customer, $_SESSION["user"]]);
}


function SearchCustomer($name = null, $issue = null, $id = null, $order = "active desc,status ")
{
    if (isset($name)) {
        return runQuery("select * from customers where store=(select id from stores where owner =?) and name like ? order by " . $order, [$_SESSION["user"], "%" . $name . "%"], single: false);
    }
    if (isset($issue)) {
        return runQuery("select * from customers where store=(select id from stores where owner =?) and issue like ? order by " . $order, [$_SESSION["user"], "%" . $issue . "%"], single: false);
    }
    if (isset($id)) {
        return runQuery("select * from customers where store=(select id from stores where owner =?) and id = ?", [$_SESSION["user"], $id], single: false);
    }
}


#endregion


#region Messages
function GetMessages()
{
    return runQuery("select * from messages where receiver=? order by datetime desc", [$_SESSION["user"]], single: false);
}

function SendMessage($sender, $receiver, $subject, $message)
{
    return runQuery("insert into messages (`sender`,`receiver`,`subject`,`message`) values (?,?,?,?)", [$sender, $receiver, $subject, $message]);
}

function RemoveMessage($messageId)
{
    return runQuery("delete from messages where id=? and receiver=?", [$messageId, $_SESSION["user"]]);
}

#endregion


#region Actions
function GetActions($storeId)
{
    return runQuery("select id,status,issue,lastUpdate  from customers where store=? and active=1 order by lastUpdate desc", [$storeId], single: false);
}
#endregion
?>

<script>
    // FORM RESUBMIT DISABLE
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>