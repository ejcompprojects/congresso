<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
    body{
        background-image: url(<?=base_url('assets/img/background2.jpg')?>);
        background-size: 100% 100%;
    }
    #form-box{
        background-color: #8a292a;
        border-radius: 2em;
        width: 35%;
        padding-top: 2%;
        padding-bottom: 2%;
        padding-left: 5%;
        padding-right: 5%;
        color: white;
        font-size: 90% !important;
    }
    .fechar{
        color: #fff;
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -ms-touch-action: manipulation;
        touch-action: manipulation;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-image: none;
        background: transparent;
        border: 0.2em solid white;
        border-radius: 0.5em;
        float: right;
    }
    .fechar:hover{
        background: rgba(255,255,255,0.2);
    }
</style>
<div id="form-container">
     <div class="panel" id="form-box">
         <h2 style="text-align: center;"><?=$msg?></h2>
     <button class="fechar" type="button" onclick="window.close();"> FECHAR </button>
     </div>
 </div>