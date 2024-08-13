<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="modalMessage"><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></p>
    </div>
</div>

<script>
    window.onload = function() {
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName('close')[0];
        var message = document.getElementById('modalMessage').textContent.trim();

        if (message) {
            modal.style.display = 'block';
            // Clear the message
            <?php unset($_SESSION['message']); ?>
        }

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    }
</script>