<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
</head>
<body>
  <p>Fuddins</p>
  <p>Rauza</p>
  <p>Alam</p>
<svg width="180" height="120"
     xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink">
  <filter id="blurMe">
    <feTurbulence 
      id="turb"
      type="fractalNoise" 
      baseFrequency="0 0" 
      numOctaves="8" 
      result="warp" />
    <animate 
      xlink:href="#turb"
      attributeName="baseFrequency"
      values="0 0;0 0.026;0 0.0" 
      repeatCount="indefinite"
      dur="30s" />
    <feDisplacementMap 
      in="SourceGraphic" 
      in2="warp"
      xChannelSelector="G" 
      yChannelSelector="B" 
      scale="100" 
      result="disp"/>
    <feGaussianBlur 
      in="disp"
      stdDeviation="3"
      result="blur" />
    <feColorMatrix
      in="blur"
      mode="matrix"
      values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 12 -3" />
  </filter>
</svg>

</body>
</html>


