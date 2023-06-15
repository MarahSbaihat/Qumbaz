<?php
function display_protected_files()
{
    $protected_files = [];

    if ($_SESSION['account_type'] == 'producer') {
        $protected_files = [
            'home.php',
            'profileforproducer.php'
        ];
    } else {
        $protected_files = [
            'home.php',
            'profileforproducer.php'
        ];
    }
    echo '<h2>الملفات المحمية</h2>';

    if (count($protected_files) == 0) {
        echo 'لا توجد ملفات محمية.';
    } else {
        echo '<ul>';
        foreach ($protected_files as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $customName = getCustomFileName($fileName); // اسم الملف الذي ترغب فيه
            echo '<li><a href="' . $file . '">' . $customName . '</a></li>';
        }
        echo '</ul>';
    }
}

function display_public_files()
{
    $public_files = [
        'index.php',
        'about.php'
    ];

    echo '<h2>الملفات العامة</h2>';

    if (count($public_files) == 0) {
        echo 'لا توجد ملفات عامة.';
    } else {
        echo '<ul>';
        foreach ($public_files as $file) {
            $fileName = pathinfo($file, PATHINFO_FILENAME);
            $customName = getCustomFileName($fileName); // اسم الملف الذي ترغب فيه
            echo '<li><a href="' . $file . '">' . $customName . '</a></li>';
        }
        echo '</ul>';
    }
}

function getCustomFileName($fileName)
{
    // قم بتعريف الأسماء الخاصة بك هنا
    // يمكنك استخدام تعبير switch-case لتعيين الأسماء حسب الملف
    switch ($fileName) {
        case 'home':
            return 'home';
        case 'profileforcustomer':
            return 'profile';
        case 'profileforproducer':
            return 'profile';
        case 'index':
            return 'central';
        case 'about':
            return 'about';
        default:
            return $fileName;
    }
}

?>

<!doctype html>
<html lang="en">

<?php
include('include/head.php');
?>

<body>

    <div class="btnTop">
        <i class="fa-solid fa-angle-up"></i>
    </div>

    <?php
    include('include/navbar.php');
    ?>

    <section class="h-100 gradient-custom-2 wow animate__animated animate__backInDown" data-wow-duration="2s">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card">
                        <div class="rounded-top text-white d-flex flex-row">
                            <div class='ms-4 mt-5 d-flex flex-column'>
                                <h5>خريطة الموقع</h5>
                            </div>
                        </div>
                        <div class='card-body p-4 text-black'>
                            <?php
                            // قم بفحص حالة تسجيل الدخول
                            if (isset($_SESSION['user'])) {
                                // إذا تم تسجيل الدخول، قم بعرض الملفات المحمية
                                display_protected_files();
                            } else {
                                // إذا لم يتم تسجيل الدخول، عرض الملفات العامة فقط
                                display_public_files();
                                echo '<p>يرجى تسجيل الدخول للوصول إلى الملفات المحمية.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('include/footer.php');
    ?>

    <?php
    include('include/script.php');
    ?>

</body>

</html>
