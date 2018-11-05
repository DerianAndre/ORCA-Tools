document.addEventListener("DOMContentLoaded", function() {
  Molvwr.process();
});
(function(){
  'use strict';
  var atomslegend = document.getElementById("atomslegend");

  function renderAtomLegend(atomkind, parentFormulaElt, parentElt){
    var node = document.createElement("span");
    node.className= "atomformula";
    node.innerHTML = '<span class="atomsymbol">' + atomkind.kind.symbol + '</span><span class="atomcount">' + (atomkind.count > 1 ? atomkind.count : "") + '</span>';
    parentFormulaElt.appendChild(node);

    var node = document.createElement("DIV");
    node.className= "atomlegend";
    node.innerHTML = '<div class="dot atom-' + atomkind.kind.symbol + '" style="background-color:rgb(' + ((255*atomkind.kind.color[0])>>0) + ',' + ((255*atomkind.kind.color[1])>>0) + ',' + ((255*atomkind.kind.color[2])>>0) + ')">' + atomkind.kind.symbol + '</div><div class="name">' + atomkind.kind.name + '</div>';
    parentElt.appendChild(node);
  }
  function renderSelectedMoleculeInfo(item, molecule){
    atomslegend.innerHTML = "";

    kinds.forEach(function(k){
      renderAtomLegend(k, formula, atomslegend);
    })
  }
});
