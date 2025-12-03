 <?php
  $isLoggedIn = isset($_SESSION['user_id']);
  ?>

 <footer>
   <div class="footer-columns">
     <div class="footer-column">
       <h5>Quick links</h5>
       <ul>
         <li><a href="../index.php" class="link">Home</a></li>
         <li><a href="../rooms.php" class="link">Rooms & Suites</a></li>

         <?php if ($isLoggedIn): ?>
           <li><a href="../my-bookings.php" class="link">My Bookings</a></li>
         <?php else: ?>
           <li><a href="../login.php" class="link">Login</a></li>
           <li><a href="../register.php" class="link">Register</a></li>
         <?php endif; ?>

         <li><a href="../wireframes.html" class="link">Wireframes</a></li>
         <li><a href="../credits.html" class="link">Credits</a></li>
       </ul>
     </div>

     <div class="footer-column">
       <h5>Contact us</h5>
       <address>
         <a href="#" class="link">Tel : 69 8234675612</a>
         <a href="#" class="link">info@marebella.gr</a>
       </address>
     </div>

     <div class="footer-column">
       <h5>Follow us</h5>
       <div class="social-icons">
         <a href="#" aria-label="Visit our Facebook page" class="social-icon"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>

         <a
           href="#"
           aria-label="Visit our Instagram page"
           class="social-icon"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>

         <a href="#" aria-label="Visit our Telegram page" class="social-icon"><i class="fa-brands fa-telegram" aria-hidden="true"></i></a>
       </div>
     </div>
   </div>

   <hr class="footer-divider" />

   <div class="footer-bottom">
     <p>&copy; <?php echo date('Y'); ?> MareBella Santorini. All rights reserved.</p>
   </div>
 </footer>