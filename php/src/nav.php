<nav>
    <!-- <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contact</a></li>
    </ul> -->

    <?php  echo "เพิ่มฐานข้อมูล"  ?> 
    
    <form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name" required>
    <br>
    
    <label>Last Name:</label>
    <input type="text" name="last_name" required>
    <br>
    
    <label>Age:</label>
    <input type="number" name="age" required>
    <br>
    
    <button type="submit" name="submit">Add User</button>
</form>

</nav>