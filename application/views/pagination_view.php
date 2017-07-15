<body>
<center>
<table border="1">
 <div id="container">
    <tr>
      <th>Teacher Name</th>
      <th>Teacher Phn No</th>
      <th>Teacher Email Id</th>
    </tr>
      <div id="body">
        <?php
        foreach($results as $data) 
        {
        ?>
           <tr> <td><?php echo $data->name ?></td> <td><?php echo $data->mobile?> </td><td><?php echo $data->email?> </td></tr>
        <?php 
        }
        ?>
   <tr>
      <td colspan="3"><center><p><?php echo $links; ?></p></center></td></tr>
  </div>
  
 </div>
 </table>
 </center>
</body>


