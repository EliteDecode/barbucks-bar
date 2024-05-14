function calculateQuantityUsed(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;

  var quantity1 = parseInt(tr.getElementsByTagName("input")[0].value);
  var quantity2 = parseInt(tr.getElementsByTagName("input")[1].value);
  var quantity3 = parseInt(tr.getElementsByTagName("input")[2].value);

  const total = quantity1 + quantity2 + quantity3;

  changeTotalQuantityUsed(total, event);
  calculateTestTubes(event);
  calculateProfit(event);
  calculateTotalProfit(event);
}

function changeTotalQuantityUsed(value, event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var tubeType = parseInt(tr.getElementsByTagName("select")[6].value);
  tr.getElementsByTagName("input")[3].value = value;
  tr.getElementsByTagName("input")[4].value = value / tubeType;
}

function calculateTestTubes(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var tubeType = tr.getElementsByTagName("select")[6].value;
  var qauntityUsed = tr.getElementsByTagName("input")[3].value;
  tr.getElementsByTagName("input")[4].value = qauntityUsed / tubeType;

  calculateProfit(event);
  calculateTotalProfit(event);
}

function calculateProfit(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var tubeType = tr.getElementsByTagName("input")[4].value;
  var qauntityUsed = tr.getElementsByTagName("input")[5].value;
  tr.getElementsByTagName("input")[6].value = qauntityUsed * tubeType;
  calculateTotalProfit(event);
}

function calculateTotalProfit(event) {
  const inputs = document.querySelectorAll(".total_input");
  let sum = 0;

  for (let i = 0; i < inputs.length; i++) {
    sum += parseFloat(inputs[i].value);
  }

  document.getElementById("TotalValue").innerHTML = sum.toFixed(2);
}
