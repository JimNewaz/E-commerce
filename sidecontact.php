<?php

include('includes/config.php');

?>





<style>
/*prio-soft floating contact form*/
body{
  margin:0;
  padding:0;
  font-family:sans-serif;
  
}
.banner{
  width:100%;
  height:100vh;
  
  background-size:cover;
} 
.content{
  padding:50px 100px;
  
}
.content h2{
  padding:0;
  margin:0 0 20px;
  font-size:30px;
}
.content p{
  font-size:18px;
}
.sidebar-contact{
  position:fixed;
  top:50%;
  left:-350px;
  transform:translateY(-50%);
  width:350px;
  height:auto;
  padding:40px;
  background:#fff;
  box-shadow: 0 20px 50px rgba(0,0,0,.5);
  box-sizing:border-box;
  transition:0.5s;
  z-index:3;
}
.sidebar-contact.active{
  left:0;
  z-index:3;
}
.sidebar-contact input,
.sidebar-contact textarea{
  width:100%;
  height:36px;
  padding:5px;
  margin-bottom:10px;
  box-sizing:border-box;
  border:1px solid rgba(0,0,0,.5);
  outline:none;
}
.sidebar-contact h2{
  margin:0 0 20px;
  padding:0;
}
.sidebar-contact textarea{
  height:60px;
  resize:none;
}
.sidebar-contact input[type="submit"]{
  background:#00bcd4;
  color:#fff;
  cursor:pointer;
  border:none;
  font-size:18px;
}
.toggle{
  position:absolute;
  height:48px;
  width:48px;
  text-align:center;
  cursor:pointer;
  background:#1FD4E4;
  top:0;
  right:-48px;
  line-height:48px;
}
.toggle:before{
  content:'\f003';
  font-family:fontAwesome;
  font-size:18px;
  color:#fff;
}
.toggle.active:before{
  content:'\f00d';
}
@media(max-width:768px)
{
  .sidebar-contact{
    width:100%;
    height:100%;
    left:-100%;
  }
  .sidebar-contact .toggle{
    top:50%;
    transform:translateY(-50%);
    transition:0.5s;
  }
  .sidebar-contact.active .toggle
  {
    top:0;
    right:0;
    transform:translateY(0);
  }
  .scroll{
    width:100%;
    height:100%;
    overflow-y:auto;
  }
  .content{
    padding:50px 50px;
  }
}
.sidebar-contact input[type="submit"]:hover{
  background:#00bcd4;
  color:black;
  cursor:pointer;
  border:none;
  font-size:18px;
}



</style>




<!--must include fontawesome cdn in <head> tag-->
<head>
  <script   src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
  <div class="sidebar-contact">
    <div class="toggle"></div>
    <h2>Contact Us</h2>
    <div class="scroll">
    <h4><?=$result; ?></h4>
    <form action="PHPMailer/sidemailer.php" method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>      
        <input type="text" name="subject" placeholder="Subject" required> 
        <textarea name="message" placeholder="Message here.." required></textarea>
        <input type="submit" name="submit" value="Send">
    </form>
    </div>
  </div>

  <script>
    $(document).ready(function () {
  $(".toggle").click(function () {
    $(".sidebar-contact").toggleClass("active");
    $(".toggle").toggleClass("active");
  });
});
  </script>
</body>
  