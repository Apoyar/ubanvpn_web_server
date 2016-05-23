
<center>
<div style='height: 35vh;'></div>
<img src='logo.gif' width='100'><br><br><br>
<p>Give us a second, we are setting everything up! This won't take long, please don't close this page.</p>
</center>
<script>
function test_con(){
  $.get("http://jsonip.com")
  .success(function(json){
    console.log(json.ip);
    history.go(-1);
  }).fail(function(){
    test_con();
  });
}
test_con();
</script>
