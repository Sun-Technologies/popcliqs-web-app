<!DOCTYPE HTML>
<html>
<head>
  <title>Popcliqs - Login</title>
  <link rel="stylesheet" type="text/css" href="web/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="web/css/popcliqs.css">
  <meta name="viewport" content="width=device-width">
</head>
<body>
<!-- nav bar--> 

<!-- <div class="navbar-fixed-top navbar-green" >
</div> -->

<div class=" navbar-fixed-top navbar-blue" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed btn-success backgroundColor1" data-toggle="collapse" data-target=".navbar-collapse" >
        Sign In
      </button>
      <div class="container" style="height:70px;">
            <a class="brand" href="home.php"> <span  style="position:relative;top:6px;" ><img src="./web/img/3.png"/></span></a>
      </div>
    </div>
    <div class="navbar-collapse collapse backgroundColor" style="height:1px;">
      <form class="navbar-form navbar-right" action="login.php" method="post" >
        <div class="form-group">
          <input type="text" name="email" placeholder="Email" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" name="password" placeholder="Password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success backgroundColor1">Sign in</button>
      </form>
    </div>
</div>
<br/>
<div class="container">
    <div class="row"  style="padding-top:80px;">
      <div class="col-md-5 col-md-offset-0">
          <div class="container">
            <h4>All Social... no media</h4>
          </div>
      		<iframe width="100%"  style="height:300px;" src="http://www.youtube.com/embed/3RyvMmlSZr0" frameborder="0" allowfullscreen>
          </iframe>
      </div>
      <div class="col-md-6 col-lg-offset-0">
        <div style="margin-bottom:20px;">
          <h4 style="display:inline;">Sign Up</h4> (Or you may never find out what XXXXX means! )
          <?php if(isset($status)) {?>
      <h3 class="notice"><?php echo $status; }?></h3>
        </div>
        <form action="" method="post">
          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="email" class="control-label">Email</label>
              </div>
              <div class="col-lg-8">
                <input type="email" id="email"  name="email" class="form-control" placeholder="me@friends.com" />
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="reemail" class="control-label">Email again</label>
              </div>
              <div class="col-lg-8">
                <input type="email" id="reemail"  name="reemail" class="form-control" placeholder="me@friends.com" />
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="password" class="control-label">Password</label>
              </div>
              <div class="col-lg-8">
                <input type="password" id="password"  name="password" class="form-control" placeholder="" />
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="sex" class="control-label">I am</label>
              </div>
              <div class="col-lg-8">
                  <input type="radio" name="sex" value="male"> Male &nbsp;
                  <input type="radio" name="sex" value="female"> Female 
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="dob" class="control-label">I was born</label>
              </div>
              <div class="col-lg-8">
                <select name="month" id="month"> 
                  <option value="">Month:</option>
                  <option value="1">January</option>
                  <option value="2">February</option>
                  <option value="3">March</option>
                  <option value="4">April</option>
                  <option value="5">May</option>
                  <option value="6">June</option>
                  <option value="7">July</option>
                  <option value="8">August</option>
                  <option value="9">September</option>
                  <option value="10">October</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
                </select>  /
                <select name="day" id="day" >
                  <option value="">Day:</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select> / 
                <select name="year" id="year">
                  <option value="">Year:</option>
                  <option value="1997">1997</option>
                  <option value="1996">1996</option>
                  <option value="1995">1995</option>
                  <option value="1994">1994</option>
                  <option value="1993">1993</option>
                  <option value="1992">1992</option>
                  <option value="1991">1991</option>
                  <option value="1990">1990</option>
                  <option value="1989">1989</option>
                  <option value="1988">1988</option>
                  <option value="1987">1987</option>
                  <option value="1986">1986</option>
                  <option value="1985">1985</option>
                  <option value="1984">1984</option>
                  <option value="1983">1983</option>
                  <option value="1982">1982</option>
                  <option value="1981">1981</option>
                  <option value="1980">1980</option>
                  <option value="1979">1979</option>
                  <option value="1978">1978</option>
                  <option value="1977">1977</option>
                  <option value="1976">1976</option>
                  <option value="1975">1975</option>
                  <option value="1974">1974</option>
                  <option value="1973">1973</option>
                  <option value="1972">1972</option>
                  <option value="1971">1971</option>
                  <option value="1970">1970</option>
                  <option value="1969">1969</option>
                  <option value="1968">1968</option>
                  <option value="1967">1967</option>
                  <option value="1966">1966</option>
                  <option value="1965">1965</option>
                  <option value="1964">1964</option>
                  <option value="1963">1963</option>
                  <option value="1962">1962</option>
                  <option value="1961">1961</option>
                  <option value="1960">1960</option>
                  <option value="1959">1959</option>
                  <option value="1958">1958</option>
                  <option value="1957">1957</option>
                  <option value="1956">1956</option>
                  <option value="1955">1955</option>
                  <option value="1954">1954</option>
                  <option value="1953">1953</option>
                  <option value="1952">1952</option>
                  <option value="1951">1951</option>
                  <option value="1950">1950</option>
                  <option value="1949">1949</option>
                  <option value="1948">1948</option>
                  <option value="1947">1947</option>
                  <option value="1946">1946</option>
                  <option value="1945">1945</option>
                  <option value="1944">1944</option>
                  <option value="1943">1943</option>
                  <option value="1942">1942</option>
                  <option value="1941">1941</option>
                  <option value="1940">1940</option>
                  <option value="1939">1939</option>
                  <option value="1938">1938</option>
                  <option value="1937">1937</option>
                  <option value="1936">1936</option>
                  <option value="1935">1935</option>
                  <option value="1934">1934</option>
                  <option value="1933">1933</option>
                  <option value="1932">1932</option>
                  <option value="1931">1931</option>
                  <option value="1930">1930</option>
                  <option value="1929">1929</option>
                  <option value="1928">1928</option>
                  <option value="1927">1927</option>
                  <option value="1926">1926</option>
                  <option value="1925">1925</option>
                  <option value="1924">1924</option>
                  <option value="1923">1923</option>
                  <option value="1922">1922</option>
                  <option value="1921">1921</option>
                  <option value="1920">1920</option>
                  <option value="1919">1919</option>
                  <option value="1918">1918</option>
                  <option value="1917">1917</option>
                  <option value="1916">1916</option>
                  <option value="1915">1915</option>
                  <option value="1914">1914</option>
                  <option value="1913">1913</option>
                  <option value="1912">1912</option>
                  <option value="1911">1911</option>
                  <option value="1910">1910</option>
                  <option value="1909">1909</option>
                  <option value="1908">1908</option>
                  <option value="1907">1907</option>
                  <option value="1906">1906</option>
                  <option value="1905">1905</option>
                  <option value="1904">1904</option>
                  <option value="1903">1903</option>
                  <option value="1902">1902</option>
                  <option value="1901">1901</option>
                  <option value="1900">1900</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
                <label for="zip" class="control-label">Home Zip</label>
              </div>
              <div class="col-lg-8">
                <input type="text" id="zip"  name="zip" class="form-control" placeholder="" />
              </div>
            </div>
          </div>
          <div class="row" style="padding-bottom:10px;">
            <div class="form-group">
              <div class="col-lg-3">
              </div>
              <div class="col-lg-7">
                By signing up, I agree to the <a href="#">Terms</a> of Use and <a href="#">Privacy Policy</a>.
              </div>
            </div>
          </div>

          <div class="row" style="padding-left:20px;padding-top:20px;"> 
              <button type="submit" class="btn btn-success backgroundColor1 col-lg-offset-3 col-lg-6">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
</div>
<hr>
<div class="container">
  <footer>
        <p>&copy; 2013 Popcliqs.com, <a href="#">About</a> | <a href="#">Privacy</a> | <a href="#">Terms</a></p>
 </footer>
</div>
<!--script src="js/jquery.js" ></script-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="web/js/bootstrap.js" ></script>

</script>
</body>
</html>
