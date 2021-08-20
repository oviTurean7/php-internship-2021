
document.addEventListener('DOMContentLoaded', (event) => {
    funct();
  });
     



function funct () {
      let arrowRight = document.createElement('div');
      let arrowLeft = document.createElement('div');
      arrowLeft.innerHTML = "&#5176;";
      arrowRight.innerHTML = "&#5171;";
      arrowLeft.classList = "arrowLeft";
      arrowRight.classList = "arrowRight";
      //console.log(document.querySelector('.elem .displayNone'));
      document.getElementById("second-container").insertBefore(arrowLeft, document.querySelector('.elem, .elem1'));
      

      let input = document.createElement('input');
      input.type = "text";
      input.classList = "search";
      input.placeholder = "filter";
      document.getElementById("second-container").insertBefore(input, document.querySelector('.arrowLeft'));
      document.getElementById("second-container").innerHTML +=
      '<div class="elem displayNone">\
      <p class="uppercase title">\
          <span>\
              <img src="pen-01-1.png">\
          </span>\
          Advies 5\
      </p>\
      <p>\
          Suspendisse eleifend, eros vitae commodo lacinia, tellus ex pretium magna, vitae venenatis tellus\
          sem a libero.\
      </p>\
      </div>\
      <div class="elem displayNone">\
      <p class="uppercase title">\
          <span>\
              <img src="pen-01-1.png">\
          </span>\
         Advies 6\
      </p>\
      <p>\
      Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non \
      numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.\
      </p>\
      </div>\
      <div class="elem displayNone">\
      <p class="uppercase title">\
          <span>\
              <img src="pen-01-1.png">\
          </span>\
          Advies 7\
      </p>\
      <p>\
          Suspendisse eleifend, eros vitae commodo lacinia, tellus ex pretium magna, vitae venenatis tellus\
          sem a libero.\
      </p>\
      </div>\
      <div class="elem displayNone">\
      <p class="uppercase title">\
          <span>\
              <img src="pen-01-1.png">\
          </span>\
          Advies 8\
      </p>\
      <p>\
          Suspendisse eleifend, eros vitae commodo lacinia, tellus ex pretium magna, vitae venenatis tellus\
          sem a libero.\
      </p>\
      </div>';
      document.getElementById("second-container").append(arrowRight);
      let pagination = document.createElement('div');
      pagination.innerHTML = '\
            <span class="prevPage">&#5176</span>\
            <span class="pageNumber"></span>\
            <span class="nextPage">&#5171;</span>\
      ';
      pagination.id = 'pagination';
      document.getElementById("third-container").append(pagination);

      let buttonModal = document.createElement("div");
      buttonModal.id = 'addModalButton';
      buttonModal.innerHTML = '<button class="orange-hover uppercase noBorder">Add post</button>';
      document.getElementById("third-container").insertBefore(buttonModal, document.querySelector(".card"));

    
      let modal = document.createElement("div");
      modal.id = "form";
      modal.style.display = "none";
      modal.innerHTML = '\
        <input class="addCard" type="text" placeholder="title" id="title" required>\
        <textarea class="addCard" type="text-area" placeholder="description" id="description" required></textarea>\
        <button id="cancelButton" type="button">Cancel</button>\
        <button id="addButton" type="sumbit">Add</button>\
        \
      ';
      document.getElementById("third-container").insertBefore(modal, document.querySelector(".card"));
      

      let icons = document.createElement("div");
      icons.style.gridColumn = "1 / span 12";
      icons.innerHTML = '<img class="edit" src="pen-01-1.png">\
      <span class="delete" class="right">\
          &#10007;\
      </span>';

      for(let i = 0; i < document.querySelectorAll(".card").length; i++)
      {
          //console.log(document.querySelectorAll(".card")[i]);
        document.querySelectorAll(".card")[i].innerHTML += icons.innerHTML;
        
      }
      document.getElementById("third-container").children[0].innerHTML += ' <span id="sort" class="down"> &#5167;</span>';
      document.querySelector(".texty-text").innerText = `Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec lobortis luctus lacinia. Nam et erat sodales, molestie ante sit amet, vehicula tortor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consequat dictum auctor. Pellentesque vulputate ac tellus sit amet sollicitudin. Maecenas egestas dui id faucibus volutpat. In semper blandit justo, eget hendrerit lorem tincidunt id. Nulla varius tellus ipsum, non finibus purus volutpat vel.

      Pellentesque et arcu sapien. Vivamus rhoncus tortor id turpis bibendum ultricies. Pellentesque id elementum nisl. Morbi eu metus venenatis, interdum sem at, placerat nunc. Ut dapibus neque elit, sit amet posuere justo ultricies sit amet. Vivamus tincidunt varius erat sed faucibus. Aliquam erat volutpat. In iaculis, leo a faucibus porta, diam massa tempus odio, quis condimentum erat dui id lectus. Nullam consequat neque eget neque tempus facilisis. Aliquam vel tristique massa. Vivamus vehicula blandit massa, ut tincidunt eros tincidunt in.`;
      document.getElementById("fourth-container").innerHTML += "<div id='ellipses'>...</div>"
      document.getElementById("fourth-container").innerHTML += "<div id='readMore' class='down'>Read more &#5167;</div>"
}