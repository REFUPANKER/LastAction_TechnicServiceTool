<?php
$con = mysqli_connect("localhost", "root", "", "LastAction");
$con->set_charset("utf8");
if ($con->connect_error) {
    die("Connection failed" . $con->connect_error);
}

session_start();

$inactive = 5 * 60;
if (isset($_SESSION['timeout'])) {
    $session_life = time() - $_SESSION['timeout'];
    if ($session_life > $inactive) {
        session_unset();
        header("Location: auth.php");
        exit();
    }
}
$_SESSION['timeout'] = time();


function runQuery($qstr, $params = [], $single = true, $returnId = false)
{
    try {
        global $con;
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
            $row = ($single == true ? $result->fetch_assoc() : $result->fetch_all());
            $stmt->close();
            return $row;
        } else {
            $result = mysqli_query($con, $qstr);
            if (!$result) {
                return;
            }
            $row = ($single == true ? mysqli_fetch_assoc($result) : mysqli_fetch_all($result));
            mysqli_free_result($result);
            return $row;
        }
    } catch (\Throwable $th) {
        return;
    }
}


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
    $_SESSION["user"] = $q;
}

function RegisterUser($name, $email, $password)
{
    $q = runQuery("insert into users (name,email,password) values (?,?,?)", [$name, $email, $password], returnId: true);
    $_SESSION["user"] = $q;
}

function LogoutUser()
{
    session_unset();
    session_destroy();
    header("location:./");
}
