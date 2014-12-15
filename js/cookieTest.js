//first write a cookie
document.cookie="test=test";
//then test if cookie is retrievable
(document.cookie.indexOf("test")!=-1)?cookieEnabled=true:cookieEnabled=false;
//alert(cookieEnabled);