<?php if (isset($_SESSION['alert'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .swal2-toast {
            width: 450px !important;
            max-width: 90% !important;
        }
        .swal2-toast .swal2-title {
            font-size: 16px !important;
            font-weight: 700 !important;
            margin-bottom: 3px;
        }
        .swal2-toast .swal2-html-container {
            font-size: 14px !important;
            font-weight: 400 !important;
            margin-top: 0;
        }
    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            width:"450px",
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: "<?= $_SESSION['alert']['icon']; ?>",
            title: "<?= $_SESSION['alert']['title']; ?>",
            text: "<?= $_SESSION['alert']['text']; ?>"
        });
    });
    </script>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>
