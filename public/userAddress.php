<!DOCTYPE html>
<html>
<head>
  <title>User Address Form</title>
</head>
<body>
  <h1>User Address Form</h1>
  <form>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone" required>
    
    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea>
    
    <label for="city">City:</label>
    <input type="text" id="city" name="city" required>
    
    <label for="state">State:</label>
    <input type="text" id="state" name="state" required>
    
    <label for="zip">Post Code:</label>
    <input type="text" id="zip" name="zip" required>
    
    <input type="submit" value="Submit">
  </form>
</body>
</html>
