    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-inner d-flex justify-content-between align-items-center flex-wrap gap-4">
                <div class="footer-left">
                    <a href="/" class="logo d-block mb-1">Talking<span>Heads</span></a>
                    <p class="mb-0">© <?= date('Y') ?> Talking Heads. All rights reserved.</p>
                </div>
                <ul class="footer-links d-flex gap-4 list-unstyled mb-0">
                    <li><a href="#work">Work</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="/products/">Products</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="/privacy.php">Privacy</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php $path_prefix = $path_prefix ?? ''; ?>
    <script src="<?= $path_prefix ?>assets/js/main.js"></script>
</body>
</html>
