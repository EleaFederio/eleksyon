<!DOCTYPE html>
<html">
<head>
<meta charset="utf-8" />
<title>CSS Newbie Example: Filtering Select Boxes</title>
<link rel="stylesheet" type="text/css" href="select.css" />
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script>
$(function () {
   $('.security').change(function () {
      $('.security option').show(0);
      $('.security option:selected').each(function () {
         oIndex = $(this).index();
         if (oIndex > 0) {
            $('.security').each(function () {
               $(this).children('option').eq(oIndex).not(':selected').hide(0);
            });
         }
      });
   });
   $('.security').change();
});
</script>
</head>
<body>
<div id="wrap">
   <h1>Intelligent Filtering of Select Boxes</h1>
   <p>The following three select boxes contain the same options. But once you've selected one of the options from one select box, that item is removed from the subsequent boxes, preventing duplicate selections. <a href="http://www.cssnewbie.com/intelligent-select-box-filtering/">Return to the original article.</a></p>
   <h2>Select Your Security Questions:</h2>
   <p>
   <select class="security" name="security1">
      <option value="0">Select a question from the following options.</option>
      <option value="1">Who's your daddy?</option>
      <option value="2">What is your favorite color?</option>
      <option value="3">What is your mother's favorite aunt's favorite color?</option>
      <option value="4">Where does the rain in Spain mainly fall?</option>
      <option value="5">If Mary had three apples, would you steal them?</option>
      <option value="6">What brand of food did your first pet eat?</option>
   </select>
   </p>
   <p>
   <select class="security" name="security2">
      <option value="0">Select a question from the following options.</option>
      <option value="1">Who's your daddy?</option>
      <option value="2">What is your favorite color?</option>
      <option value="3">What is your mother's favorite aunt's favorite color?</option>
      <option value="4">Where does the rain in Spain mainly fall?</option>
      <option value="5">If Mary had three apples, would you steal them?</option>
      <option value="6">What brand of food did your first pet eat?</option>
   </select>
   </p>
   <p>
   <select class="security" name="security3">
      <option value="0">Select a question from the following options.</option>
      <option value="1">Who's your daddy?</option>
      <option value="2">What is your favorite color?</option>
      <option value="3">What is your mother's favorite aunt's favorite color?</option>
      <option value="4">Where does the rain in Spain mainly fall?</option>
      <option value="5">If Mary had three apples, would you steal them?</option>
      <option value="6">What brand of food did your first pet eat?</option>
   </select>
   </p>
</div>
</body>
</html>

