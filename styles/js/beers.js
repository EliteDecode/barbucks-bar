function calculateQuantity(event) {
  if (event.keyCode == 13) {
    calculateTotal(event);
    calculateProfit(event);
    calculateTotalProfit(event);
  }
}

function calculateTotal(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;
  var pricePerCan = tr.getElementsByTagName("input")[0].value;
  var priceOfDrink = tr.getElementsByTagName("input")[2].value;
  var totalDrinks = tr.getElementsByTagName("input")[1].value;

  var grossSale = tr.getElementsByTagName("input")[3];
  var cogUsed = tr.getElementsByTagName("input")[4];
  grossSale.value = totalDrinks * priceOfDrink;
  cogUsed.value = totalDrinks * pricePerCan;
}

function calculateProfit(event) {
  var target = event.target;
  var td = target.parentNode;
  var tr = td.parentNode;

  var grossSale = parseFloat(tr.getElementsByTagName("input")[3].value);
  var cogUsed = parseFloat(tr.getElementsByTagName("input")[4].value);

  tr.getElementsByTagName("input")[5].value = (grossSale - cogUsed).toFixed(2);
}

function calculateTotalProfit(event) {
  var TotalValue = document.getElementById("#TotalValue").value;

  console.log(TotalValue);
}
