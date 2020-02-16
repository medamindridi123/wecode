<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body{
        margin:0;
        padding:0;
        display:flex;
        
    }
        .container {
  position: relative;
  width: 50%;
  height:100vh;
  overflow:hidden;
}

/* Make the image responsive */
.container img {
  width: 100%;
  height: auto;
}

/* Style the button and place it in the middle of the container/image */
.container .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: rgba(0 ,0 ,0 ,0.5);
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-decoration:none;
  font-size:20px;
}

.container .btn:hover {
  background-color: black;
}
    </style>
</head>
<body>
    <div class="container">
        <img src="images/pexels-photo-3184338.jpeg" alt="Snow">
        <a href="wlog.php" class="btn">Login as worker</a>
    </div>
    <div class="container">
        <img src="images/img2.jpeg" alt="Snow">
        <a href="c_log.php" class="btn">Login as admin</a>
    </div>
</body>
</html>