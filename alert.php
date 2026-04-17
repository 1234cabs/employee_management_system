<?php if(isset($_SESSION['error'])) { ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        timer: 2000,

        text: '<?= $_SESSION['error']; ?>'
    })
</script>
<?php unset($_SESSION['error']); } ?>

<?php if(isset($_SESSION['success'])) { ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        timer: 2000,

        text: '<?= $_SESSION['success']; ?>'
    })
</script>
<?php unset($_SESSION['success']); } ?>