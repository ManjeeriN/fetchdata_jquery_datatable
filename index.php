<html>
<head>
  <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
</head>
<body>

 <table id="example">
  <thead>
    <tr><th class="site_name">Name</th><th>Url </th><th>Type</th><th>Last modified</th></tr>
  </thead>
  <tbody>
  </tbody>
</table>


  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
 
  <script>

      // $(function(){
      //   $("#example").dataTable();
      // })


  $("#example").dataTable({

  // "iTotalRecords": 50,
  // "iTotalDisplayRecords": 10,
  // "sEcho":10,


  "aaData":[

     <?php 
    $conn = mysql_connect('localhost','root','') or die('error');
    $db = mysql_select_db('datatable',$conn) or die('error');

    $sql = mysql_query("SELECT * FROM sites");
    while($row=mysql_fetch_array($sql))
    {
     ?>
          ["<?=$row['site_name']?>","<?=$row['url']?>","<?=$row['type']?>","<?=$row['modified']?>"],
    <?php } ?>
   
  ],

  "aoColumnDefs":[{
        "sTitle":"Site name"
      , "aTargets": [ "site_name" ]
  }
  ,{
        "aTargets": [ 1 ]
      , "bSortable": false   //whether to sort or not
      , "mRender": function ( url )  { // create link on url
          return  '<a target ="_blank" href="'+url+'">' + url + '</a>';
      }
  },
  {
       "aTargets":[ 3 ]
      , "sType": "date"
      , "mRender": function(date, type, full) {
          return (full[2] == "Ecomm") 
                    ? new Date(date).toDateString()
                    : "N/A" ;
        // if 3rd column contains Ecomm then display date else display N/A
      }  
  }]

});

  </script>

</body>
</html>
