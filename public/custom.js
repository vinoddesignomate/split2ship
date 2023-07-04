$(document).ready(function(){
    // Mobile header
$(window).load(function() {
    $(".payxnowandrestondelivery-icon").on("click", function() {
      $(".payxnowandrestondelivery-header-nav-links").toggleClass("payxnowandrestondelivery-show");
      $(this).toggleClass("payxnowandrestondelivery-animated");
      
    });
  });

});
// custom select
(function($) {
    $(document).ready(function() {
      var customSelect = $(".payxnowandrestondelivery-custom-select");
  
      customSelect.each(function() {
        var thisCustomSelect = $(this),
          options = thisCustomSelect.find("option"),
          firstOptionText = options.first().text();
  
        var selectedItem = $("<div></div>", {
          class: "payxnowandrestondelivery-selected-item"
        })
          .appendTo(thisCustomSelect)
          .text(firstOptionText);
  
        var allItems = $("<div></div>", {
          class: "payxnowandrestondelivery-all-items payxnowandrestondelivery-all-items-hide"
        }).appendTo(thisCustomSelect);
  
        options.each(function() {
          var that = $(this),
            optionText = that.text();
  
          var item = $("<div></div>", {
            class: "payxnowandrestondelivery-item",
            on: {
              click: function() {
                var selectedOptionText = that.text();
                selectedItem.text(selectedOptionText).removeClass("payxnowandrestondelivery-arrowanim");
                allItems.addClass("payxnowandrestondelivery-all-items-hide");
              }
            }
          })
            .appendTo(allItems)
            .text(optionText);
        });
      });
  
      var selectedItem = $(".payxnowandrestondelivery-selected-item"),
        allItems = $(".payxnowandrestondelivery-all-items");
  
      selectedItem.on("click", function(e) {
        var currentSelectedItem = $(this),
          currentAllItems = currentSelectedItem.next(".payxnowandrestondelivery-all-items");
  
        allItems.not(currentAllItems).addClass("payxnowandrestondelivery-all-items-hide");
        selectedItem.not(currentSelectedItem).removeClass("payxnowandrestondelivery-arrowanim");
  
        currentAllItems.toggleClass("payxnowandrestondelivery-all-items-hide");
        currentSelectedItem.toggleClass("payxnowandrestondelivery-arrowanim");
  
        e.stopPropagation();
      });
  
      $(document).on("click", function() {
        var opened = $(".payxnowandrestondelivery-all-items:not(.payxnowandrestondelivery-all-items-hide)"),
          index = opened.parent().index();
  
        customSelect
          .eq(index)
          .find(".payxnowandrestondelivery-all-items")
          .addClass("payxnowandrestondelivery-all-items-hide");
        customSelect
          .eq(index)
          .find(".payxnowandrestondelivery-selected-item")
          .removeClass("payxnowandrestondelivery-arrowanim");
      });
    });
  })(jQuery);
  