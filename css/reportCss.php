<style type="text/css">
<?php

?>
/*Verticle Table*/
/*----------------------*/
table.rptVerTable{
    width: 100%;
    border-collapse:collapse;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}
table.rptVerTable tr td, table.rptVerTable tr th{
    border:2px solid white;
    padding : .5rem;
    text-align: left;
    font-size: 11px;
}
table.rptVerTable tr td{
    font-weight:normal;
}
table.rptVerTable tr th {
    width :25%;
    font-weight:bold;
    background-color: #f1f1f1;
}

/*Horizontail Table*/
/*----------------------*/
table.rptTable{
    width: 100%;
    border-collapse:collapse;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}
table.rptTable tr td{
    border:1px solid black;
}
.rptTblHeader {
    font-size: 11px;
    text-align: center;
    font-weight:bold;
}
.rptTblBody {
    font-size: 10px;
}
.drillLink{
    cursor:pointer;
}
a:hover
{ 
    font-weight: bold;
    text-decoration:underline;
    color: #0000FF;
}
.loadTime{
  font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 12px;
}

body {
/*  font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 12px;*/
}

.displayParameter{
  font-size: 12px;
  list-style: disc;
}
.printBtn{
  display: block;
  margin-top: 50px;
}

/*=========================================*/
/*========== Print Formatting ===============*/
/*=========================================*/
td {
  font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  font-size: 12px;
}
.printHeaderDetails div:not(.displayParameter) {
  display:list-item; 
  width:90mm; 
  float: left;
  font-size: 11px;
  list-style: disc;
}
.printHeaderDetails div strong{
  width: 25mm;
  min-width: 25mm;
  max-width: 30mm;
  display: inline-block;
}
.printHeaderDetails .remarks{
  margin-top: 10px;
  display:list-item; 
  list-style: disc;
  font-size: 11px;
  width: 100%;
  min-width: 100%;
  max-width: 100%;
  float: left;
}
.printHeaderDetails .remarks strong {
  width: 100%;
  min-width: 100%;
  max-width: 100%;
  display: block;
}
.rptTable{
  font-size: 11px;
  font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
}
.rptTable .totalValue{
  border-bottom: 2px solid black;
  border-style: double;
}
.rptTable .totalText{
  border-bottom: none;
  border-left: none;
}

@media print{
  @page {
    margin-left: 15mm;
    margin-top: 10mm;
    margin-bottom: 10mm;
    margin-right: 5mm;
    size: A4;
    font-family: "Nunito", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  }
  .printBtn, .loadTime{
    display: none;
  }

  .printDoc{
    width: 100%;
    height: auto;
    margin: 0;
    content: none !important;
  }
  
/*
a[href]:after {
    content: none !important;
  }*/

}
/*=================*/
/*Tool Tip display for column header*/
.tooltip{
    position: absolute;
    display: none;
    z-index: 9999;
    background-color: #444;
    border: 1px solid #444;
    color: white;
    font-size: 12px;
    padding: .5mm;
}
@media only print{    
    .tooltip{
        z-index: -1;
    }
}
</style>