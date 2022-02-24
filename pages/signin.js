function obscurePassword() {
  const x = document.querySelector("#password");

  const type = x.getAttribute("type") === "password" ? "text" : "password";
  x.setAttribute("type", type);

  // if (x.type === "password") {
  //   x.type = "text";
  // } else {
  //   x.type = "password";
  // }
  // console.log("test");
}