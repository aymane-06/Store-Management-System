<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : [];

$name = $email = $password = "";



extract(isset($_SESSION['old']) ? $_SESSION['old'] : []);
// print_r($_SESSION);

$_SESSION['old'] = null;
$_SESSION['error'] = null;


// include $_SERVER['DOCUMENT_ROOT'].'/Store-Management-System/vendor/autoload.php';

include '../layout/header.php';
?>

<div class="font-[sans-serif] bg-white md:h-screen">
    <div class="grid md:grid-cols-2 items-center gap-8 h-full">
        <div class="max-md:order-1 p-4 bg-gray-50 h-full">
            <img src="https://readymadeui.com/signin-image.webp" class="lg:max-w-[90%] w-full h-full object-contain block mx-auto" alt="login-image" />
        </div>

        <div class="flex items-center p-6 h-full w-full">
            <form action="/Store-Management-System/router/web.php" method="POST" class="max-w-lg w-full mx-auto">
                <div class="mb-12">
                    <h3 class="text-blue-500 md:text-3xl text-2xl font-extrabold max-md:text-center">Create an account</h3>
                </div>

                <!-- Full Name -->
                <div>
                    <input type="hidden" name="url" value="adduser">
                    <label class="text-gray-800 text-xs block mb-2">Full Name</label>
                    <div class="relative flex items-center">
                        <input name="name" type="text" value="<?php echo htmlspecialchars($name); ?>" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter name" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 24 24">
                            <circle cx="10" cy="7" r="6"></circle>
                            <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z"></path>
                        </svg>
                    </div>
                    <h1 class="text-red-600"><?php echo $error['name'] ?? ''; ?></h1>
                </div>

                <!-- Email -->
                <div class="mt-6">
                    <label class="text-gray-800 text-xs block mb-2">Email</label>
                    <div class="relative flex items-center">
                        <input name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter email" />
                    </div>
                    <h1 class="text-red-600"><?php echo $error['email'] ?? ''; ?></h1>
                </div>

                <!-- Password -->
                <div class="mt-6">
                    <label class="text-gray-800 text-xs block mb-2">Password</label>
                    <div class="relative flex items-center">
                        <input name="password" type="password" required class="w-full bg-transparent text-sm border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" value="<?php echo htmlspecialchars($password); ?>" placeholder="Enter password" />
                    </div>
                    <h1 class="text-red-600"><?php echo $error['password'] ?? ''; ?></h1>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center mt-6">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 rounded" required />
                    <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                        I accept the <a href="javascript:void(0);" class="text-blue-500 font-semibold hover:underline ml-1">Terms and Conditions</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="mt-12">
                    <button type="submit" name="submit" class="w-full py-3 px-6 text-sm tracking-wider font-semibold rounded-md bg-blue-600 hover:bg-blue-700 text-white focus:outline-none">
                        Create an account
                    </button>
                    <p class="text-sm mt-6 text-gray-800">Already have an account? <a href="/Store-Management-System/app/views/pages/sginIn.php" class="text-blue-500 font-semibold hover:underline ml-1">Login here</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include '../layout/footer.php';
    
    ?>