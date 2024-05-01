
const chart5 = document.querySelector("#ayudas_tec").getContext("2d");


console.log("hoola")

$(document).ready(function(){
    
      Ayuda_tec();
      
  
  
  })
      function Ayuda_tec(){
          $.ajax({
              type:"POST",
              url:"graficas_ayudas_tec/ayudastec.php",
              success: function(ayudas){
                  var reg = eval(ayudas);
                  var sillas = reg[0];
                  var muletas = reg[1];
                  var baston = reg[2];
                  var baston4 = reg[3];
                  var aparato = reg[4];
                  var andadera = reg[5];
                  var cama = reg[6];
                  var colchon = reg[7];
                  var felula = reg[8];
                  var lentes = reg[9];
                  var pañales = reg[10];
                  var ProtesisA = reg[11];
                  var ProtesisC = reg[12];
                  var ProtesisR = reg[13];
                  var ProtesisD = reg[14];


                  var E16 = reg[15]
                  var E18 = reg[16]
                  var E14 = reg[17]
                  var SRA = reg[18]
                  var SRPE = reg[19]
                  var SRB = reg[20]
                  var COP = reg[20]
                 
                
                  

                  new Chart(chart5, {
                    type: "line",
                    data: {
                        labels: ["silla de ruedas", "Muletas", "Baston", "Baston 4 Puntas", "Aparato", "andadera","cama", "colchon", "felula", "lentes", "pañales", "ProtesisA", "ProtesisC", "ProtesisR", "ProtesisD",
                    "S-Ergonomica 16","S-Ergonomica 18", "S-Ergonomica 14", "S.reclinable-A" ,"S-pediátrica", "S-bariátricas", "Coche Pediatrico" ],
                        datasets: [
                            
                        {
                            label: "Ayudas tecnicas",
                            data: [sillas, muletas,baston, baston4, aparato, andadera, cama, colchon, felula, lentes, pañales, ProtesisA, ProtesisC, ProtesisR, ProtesisD, 
                            E16, E18, E14, SRA, SRPE, SRB, COP], 
                            borderColor: "#38b000",
                            borderWidth: 2
                
                        }
                        
                    ]
                    }, 
                
                    options:{
                        responsive: true
                    }
                })
                  
              }
          });
      }

