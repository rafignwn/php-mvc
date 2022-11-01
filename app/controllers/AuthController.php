<?php
class AuthController extends Controller
{
    private $modelUser;

    public function __construct()
    {
        $this->modelUser = $this->model("users");
    }

    public function login()
    {
        $email_or_username = $_POST["username"];
        $password = $_POST["password"];
        $valid = $this->modelUser->checkEmailOrUsername($email_or_username);
        $user = $this->modelUser->check($email_or_username, $password);

        // validation email
        if (!$valid) {
            Flasher::setFlaser("Username or email is wrong!", "danger");
            return $this->redirectTo("/");
        }

        // final validation 
        if (!$user) {
            Flasher::setFlaser("Password is wrong!", "danger");
            return $this->redirectTo("/");
        }

        Flasher::setFlaser("Welcome back, " . $user['name'], "shake");

        $_SESSION["auth"] = [
            "username" => $user["username"],
            "email" => $user["email"],
            "name" => $user["name"],
            "address" => $user["address"],
            "phone_number" => $user["phone_number"]
        ];
        return $this->redirectTo("/");
    }

    public function signin()
    {
        $email_or_username = $_POST["username"];
        $password = $_POST["password"];
        $valid = $this->modelUser->checkEmailOrUsername($email_or_username);
        $user = $this->modelUser->check($email_or_username, $password);
        $data = [
            'success' => false,
            'error' => false,
        ];

        // validation email
        if (!$valid || empty($email_or_username)) {
            $data = [
                'error' => true,
                'flasher' => [
                    'pesan' => 'Email or username is wrong!',
                    'type' => 'danger',
                ]
            ];
            echo json_encode($data);
            return false;
        }

        // final validation 
        if (!$user) {
            $data = [
                'error' => true,
                'flasher' => [
                    'pesan' => 'Password is wrong!',
                    'type' => 'danger',
                ]
            ];
            echo json_encode($data);
            return false;
        }

        $_SESSION["auth"] = [
            "username" => $user["username"],
            "email" => $user["email"],
            "name" => $user["name"],
            "address" => $user["address"],
            "phone_number" => $user["phone_number"]
        ];

        $data = [
            'success' => true,
            'name' => $user['name'],
            'flasher' => [
                'pesan' => 'Welcome back, ' . $user['name'],
                'type' => 'shake',
            ]
        ];

        echo json_encode($data);
        return false;
    }

    public function register()
    {
        // get validate for email and username
        $emailExist = $this->modelUser->checkEmailOrUsername($_POST["email"]);
        $usernameExist = $this->modelUser->checkEmailOrUsername($_POST["username"]);

        // check email and username whether it's user or not
        if ($emailExist || $usernameExist) {
            // if one already used
            $failMessage = $emailExist ? "email" : "username";

            // if both already used;
            if ($emailExist && $usernameExist) {
                $failMessage = "email and username";
            }

            // fail message 
            Flasher::setFlaser("Failed, $failMessage already used", "danger");
        } else {
            // add user
            if ($this->modelUser->addUser($_POST)) {
                // success message
                Flasher::setFlaser("Account created successfully", "success");
            } else {
                // fail message
                Flasher::setFlaser("Failed to create account", "danger");
            }
        }

        // redirect to home
        return $this->redirectTo("/");
    }

    public function logout()
    {
        Flasher::setFlaser("Bye bye, " . $_SESSION['auth']['name'], "shake");
        unset($_SESSION["auth"]);
        $this->redirectTo("/");
    }
}
