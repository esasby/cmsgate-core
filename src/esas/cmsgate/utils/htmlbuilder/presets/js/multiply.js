function multiply($priceElementId, $countElementId, $totalElementId) {
    var $priceElement = document.getElementById($priceElementId);
    var $countElement = document.getElementById($countElementId);
    var $totalElement = document.getElementById($totalElementId);
    //todo check node type
    $totalElement.textContent = $priceElement.value * $countElement.value;
}