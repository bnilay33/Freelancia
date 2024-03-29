<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/review.css">
</head>

<body>
    <div class="container">

        <div class="boxs">

            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center">
                    <div class="stars">
                        <?php
                        if(isset($_POST['review'])){
                            echo $_POST['rate'];
                        }
                        ?>
                        <input type="radio" id="five" name="rate" value="5">
                        <label for="five"></label>
                        <input type="radio" id="four" name="rate" value="4">
                        <label for="four"></label>
                        <input type="radio" id="three" name="rate" value="3">
                        <label for="three"></label>
                        <input type="radio" id="two" name="rate" value="2">
                        <label for="two"></label>
                        <input type="radio" id="one" name="rate" value="1">
                        <label for="one"></label>
                        <span class="result"></span>
                    </div>
                </div>

                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>
                <div>
                    <button name="review">Review</button>
                    
                  </div>

                  
              
            </div>
            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center2">
                    <div class="stars2">
                        <input type="radio" id="five5" name="rate" value="5">
                        <label for="five5"></label>
                        <input type="radio" id="four4" name="rate" value="4">
                        <label for="four4"></label>
                        <input type="radio" id="three3" name="rate" value="3">
                        <label for="three3"></label>
                        <input type="radio" id="two2" name="rate" value="2">
                        <label for="two2"></label>
                        <input type="radio" id="one1" name="rate" value="1">
                        <label for="one1"></label>
                        <span class="result2"></span>
                    </div>
                </div>

                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>

            </div>
            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center3">
                    <div class="stars3">
                        <input type="radio" id="five55" name="rate" value="5">
                        <label for="five55"></label>
                        <input type="radio" id="four44" name="rate" value="4">
                        <label for="four44"></label>
                        <input type="radio" id="three33" name="rate" value="3">
                        <label for="three33"></label>
                        <input type="radio" id="two22" name="rate" value="2">
                        <label for="two22"></label>
                        <input type="radio" id="one11" name="rate" value="1">
                        <label for="one11"></label>
                        <span class="result3"></span>
                    </div>
                </div>
                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>


            </div>
            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center4">
                    <div class="stars4">
                        <input type="radio" id="five555" name="rate" value="5">
                        <label for="five555"></label>
                        <input type="radio" id="four444" name="rate" value="4">
                        <label for="four444"></label>
                        <input type="radio" id="three333" name="rate" value="3">
                        <label for="three333"></label>
                        <input type="radio" id="two222" name="rate" value="2">
                        <label for="two222"></label>
                        <input type="radio" id="one111" name="rate" value="1">
                        <label for="one111"></label>
                        <span class="result4"></span>
                    </div>
                </div>
                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>

            </div>
            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center5">
                    <div class="stars5">
                        <input type="radio" id="five5555" name="rate" value="5">
                        <label for="five5555"></label>
                        <input type="radio" id="four4444" name="rate" value="4">
                        <label for="four4444"></label>
                        <input type="radio" id="three3333" name="rate" value="3">
                        <label for="three3333"></label>
                        <input type="radio" id="two2222" name="rate" value="2">
                        <label for="two2222"></label>
                        <input type="radio" id="one1111" name="rate" value="1">
                        <label for="one1111"></label>
                        <span class="result5"></span>
                    </div>
                </div>
                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>

            </div>
            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center6">
                    <div class="stars6">
                        <input type="radio" id="five55555" name="rate" value="5">
                        <label for="five55555"></label>
                        <input type="radio" id="four44444" name="rate" value="4">
                        <label for="four44444"></label>
                        <input type="radio" id="three33333" name="rate" value="3">
                        <label for="three33333"></label>
                        <input type="radio" id="two22222" name="rate" value="2">
                        <label for="two22222"></label>
                        <input type="radio" id="one11111" name="rate" value="1">
                        <label for="one11111"></label>
                        <span class="result6"></span>
                    </div>
                </div>
                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>


            </div>

            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center7">
                    <div class="stars7">
                        <input type="radio" id="five555555" name="rate" value="5">
                        <label for="five555555"></label>
                        <input type="radio" id="four444444" name="rate" value="4">
                        <label for="four444444"></label>
                        <input type="radio" id="three333333" name="rate" value="3">
                        <label for="three333333"></label>
                        <input type="radio" id="two222222" name="rate" value="2">
                        <label for="two222222"></label>
                        <input type="radio" id="one111111" name="rate" value="1">
                        <label for="one111111"></label>
                        <span class="result7"></span>
                    </div>
                </div>
                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>


            </div>

            <div class="box">
                <img src="images/dark-blue-product-background.jpg" alt="">
                <h2>Microsoft</h2>
                <h3>Python</h3>

                <div class="center8">
                    <div class="stars8">
                        <input type="radio" id="five5555555" name="rate" value="5">
                        <label for="five5555555"></label>
                        <input type="radio" id="four4444444" name="rate" value="4">
                        <label for="four4444444"></label>
                        <input type="radio" id="three3333333" name="rate" value="3">
                        <label for="three3333333"></label>
                        <input type="radio" id="two2222222" name="rate" value="2">
                        <label for="two2222222"></label>
                        <input type="radio" id="one1111111" name="rate" value="1">
                        <label for="one1111111"></label>
                        <span class="result8"></span>
                    </div>
                </div>
                <div class="centered">
                    <label><input type="text" class="textfield" required><span class="placeholder">Feedback</span></label>
                </div>

                <div>
                    <button>Review</button>
                    
                  </div>


            </div>

            

            



            
        </div>

        

        
      
    </div>


    <script src="js/review.js"></script>
</body>

</html>