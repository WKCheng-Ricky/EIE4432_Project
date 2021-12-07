
<style>
    /* Full-width input fields */

    .header input[type=text], .header input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }


    .header_login_btn {
    background-color: #04AA6D;
    color: white;
    border-radius: 8px;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    }

    .header button:hover {
    opacity: 0.8;
    }

    /* Extra styles for the cancel button */
    .header_cancel_btn {
        background-color: #f44336;
        color: white;
        border-radius: 8px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        width: auto;
        padding: 10px 18px;
    }

    /* The Modal (background) */
    .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
    background-color: white;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
    }

    /* Add Zoom Animation */
    .animate {
    animation: animatezoom 0.2s
    }
    
    @keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
    }
</style>

<form class="modal-content animate" action="login_logic.php" method="post">

    <div class='header'>
        <div style="padding:16px">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="pwd"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pwd" required>
            
            <button type="submit" name="login-submit" class="header_login_btn">Login</button>
        </div>

        <div style="background-color:#f1f1f1;padding:16px">
            <button type="button" onclick="document.getElementById('login_prompt').style.display='none'" class="header_cancel_btn">Cancel</button>
            <span><a href="forgetpwd.php">Forgot password?</a></span>
        </div>
    </div>

    
</form>
