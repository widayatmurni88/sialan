<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat tanggung Jawab</title>
  <!--Resource-->
  <style>
    *{
      margin:8px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }
    body{
      font-family:Arial, Helvetica, sans-serif;
      font-size: .7rem;
    }
    table{
      width: 100%;
      border-collapse: collapse;
      white-space: nowrap;
    }
    table, th, td {
      border: 1px solid black;
    }
    th, td{
      width: 15px;
    }
    .text-center{
      text-align: center; 
    }
    .tgl{
    }
    .wrap-box {
        padding-top: 40px;
        position: relative;
        width: 100%;
        font-size: 0.8rem;
      } 

    .box {
        position: absolute;
        top: 10px;
        right: 0;
        width: 400px;
        height: 30px;
        text-align: center;
      }

    .page-break {
      page-break-after: always;
      margin: -8px;
      overflow: hidden;
    } 
    

  </style>
  
</head>
<body>

  <img src="{{ public_path('docs/pernyataan/'.$file )}}" style="">
  
</body>
</html>