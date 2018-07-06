<?php
  include 'db_connect.php';
  $postdata = file_get_contents("php://input");
  $jenis = '';
  $request = json_decode($postdata);
  $jenis = $request->jenis;

    $query_posts = mysqli_query($connect,"SELECT p.postid, p.usernim, p.jenis, p.judul, p.deskripsi, p.date_time, u.nama, u.email, u.no_hp, (SELECT COUNT(postid) FROM comment WHERE postid=p.postid) AS count FROM post p, user u WHERE p.usernim=u.nim && p.jenis='$jenis' ORDER BY p.date_time DESC");
    if(mysqli_num_rows($query_posts)){
         while($result=mysqli_fetch_assoc($query_posts)){
            $results_set[]=$result;
         }
         $data = array(
            'message' => "Data Query Success",
            'data' => $results_set,
            'status' => "200"
         );
     }
     else {
         $data =array(
             'message' => "Data Query Failed!",
             'status' => "404"
         );
     }
     
    echo json_encode($data);
?>