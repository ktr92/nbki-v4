var rangeTimeout

function rangeSliderCreate(slideIndex, slide) {
  var rangeSliderOptions
  var rangeSliderType = $(slide).attr("data-range-slider-type")
  var rangeSliderStart = parseFloat(
    $(slide).find(".form-control").val().replace(/\s/g, "")
  )
  var rangeSliderMin = parseFloat(
    $(slide).closest(".range-slider").find(".form-control").data("min")
  )
  var rangeSliderMax = parseFloat(
    $(slide).closest(".range-slider").find(".form-control").data("max")
  )

  if (rangeSliderType === "calc_summ") {
    rangeSliderOptions = {
      start: [rangeSliderStart],
      range: {
        min: [rangeSliderMin, 1],
        "20%": [100000, 1000],
        "30%": [500000, 5000],
        "50%": [5000000, 10000],
        max: [rangeSliderMax],
      },
      connect: "lower",
    }
  } else if (rangeSliderType === "volume") {
    rangeSliderOptions = {
      start: [rangeSliderStart],
      range: {
        min: [rangeSliderMin, 0.01],
        "40%": [0.5, 0.05],
        "50%": [1, 0.1],
        "76%": [3, 0.5],
        "88%": [10, 1],
        max: [rangeSliderMax],
      },
      connect: "lower",
    }
  } else if (rangeSliderType === "size") {
    rangeSliderOptions = {
      start: [rangeSliderStart],
      range: {
        min: [rangeSliderMin, 1],
        "28%": [15, 1],
        "48%": [30, 5],
        "60%": [100, 10],
        "70%": [300, 20],
        "80%": [500, 20],
        max: [rangeSliderMax],
      },
      connect: "lower",
    }
  } else if (rangeSliderType === "height") {
    rangeSliderOptions = {
      start: [rangeSliderStart],
      range: {
        min: [rangeSliderMin, 1],
        "28%": [15, 1],
        "48%": [30, 5],
        "60%": [100, 10],
        "80%": [300, 20],
        max: [rangeSliderMax],
      },
      connect: "lower",
    }
  } else {
    rangeSliderOptions = {
      start: [rangeSliderStart],
      range: {
        min: [rangeSliderMin],
        max: [rangeSliderMax],
      },
      connect: "lower",
    }
  }

  $(slide).attr("data-range-slider-index", slideIndex)

  var rangeSlidersItem = noUiSlider.create(
    slide.querySelector(".range-slider__ui"),
    rangeSliderOptions
  )

  $(slide.querySelector(".range-slider__ui")).data("slider", rangeSlidersItem)

  rangeSlidersItem.on("slide", function (values, handle) {
    clearTimeout(rangeTimeout)
    if (
      1
      /*   rangeSliderType === "calc_summ" ||
      rangeSliderType === "size" ||
      rangeSliderType === "height" ||
      rangeSliderType === "count"  */
    ) {
      $(this.target)
        .closest(".range-slider")
        .find(".form-control")
        .val(Math.round(values[handle]))
    } else if (rangeSliderType === "volume") {
      $(this.target)
        .closest(".range-slider")
        .find(".form-control")
        .val(parseFloat(values[handle]).toFixed(2) /* + ' РјВі'*/)
    } else {
      $(this.target)
        .closest(".range-slider")
        .find(".form-control")
        .val(values[handle])
    }
  })
  rangeSlidersItem.on("change", function () {
    var target = $(this.target)
    rangeTimeout = setTimeout(function () {
      target.closest(".range-slider").find(".form-control").trigger("change")
    }, 500)
  })
}

function rangeSliderInit(rangeSliders) {
  for (var i = 0; i < rangeSliders.length; i++) {
    rangeSliderCreate(i, rangeSliders[i])
  }

  $(".range-slider__control").on("change", function () {
    if (
      $(this).closest(".range-slider").attr("data-range-slider-type") === "size"
    ) {
      if (
        this.value.replace(/[^0-9]/g, "") >
        parseInt(this.getAttribute("data-max"))
      ) {
        this.value = parseInt(this.getAttribute("data-max"))
      } else if (
        this.value.replace(/[^0-9]/g, "") <
          parseInt(this.getAttribute("data-min")) ||
        this.value.replace(/[^0-9]/g, "") === ""
      ) {
        this.value = parseInt(this.getAttribute("data-min"))
      }
      $(this)
        .next()
        .data("slider")
        .set(parseInt(this.value.replace(/[^0-9]/g, "")))
    }

    if (
      1
      /*  $(this).closest(".range-slider").attr("data-range-slider-type") ===
      "calc_summ" */
    ) {
      if (
        this.value.replace(/[^0-9]/g, "") >
        parseInt(this.getAttribute("data-max"))
      ) {
        this.value = parseInt(this.getAttribute("data-max"))
      } else if (
        this.value.replace(/[^0-9]/g, "") <
          parseInt(this.getAttribute("data-min")) ||
        this.value.replace(/[^0-9]/g, "") === ""
      ) {
        this.value = parseInt(this.getAttribute("data-min"))
      }
      $(this)
        .next()
        .data("slider")
        .set(parseInt(this.value.replace(/[^0-9]/g, "")))
      if (0) {
        if (
          parseInt(
            $('[name="max"]')
              .val()
              .replace(/[^0-9]/g, "")
          ) >
          parseInt(
            $('[name="calc_summ"]')
              .val()
              .replace(/[^0-9]/g, "")
          )
        ) {
          $('[name="calc_summ"]').val($('[name="max"]').val())
          $('[name="calc_summ"]')
            .next()
            .data("slider")
            .set(parseInt(this.value.replace(/[^0-9]/g, "")))
        }
      }
    } else if (
      $(this).closest(".range-slider").attr("data-range-slider-type") ===
      "volume"
    ) {
      if (parseFloat(this.value) > parseFloat(this.getAttribute("data-max"))) {
        this.value = parseFloat(this.getAttribute("data-max"))
      } else if (
        parseFloat(this.value) < parseFloat(this.getAttribute("data-min")) ||
        parseFloat(this.value) === ""
      ) {
        this.value = parseFloat(this.getAttribute("data-min"))
      }
      if (!parseFloat(this.value) || parseFloat(this.value) === 0) {
        this.value = parseFloat(this.getAttribute("data-min"))
      }
      $(this)
        .next()
        .data("slider")
        .set(parseFloat(this.value /*.replace(/[^0-9]/g, '')*/).toFixed(2))
    }
  })
}

$(document).ready(function () {
  $("[data-summ-format]").inputmask("integer", {
    mask: "( 999){+|1}",
    numericInput: true,
    showMaskOnHover: false,
    showMaskOnFocus: false,
    rightAlign: false,
  })

  $("[data-volume-format]").inputmask({
    rightAlign: false,
    alias: "numeric",
    digits: 2,
    suffix: " м³",
    showMaskOnHover: false,
    showMaskOnFocus: false,
  })
  $("[data-size-format]").inputmask({
    mask: "( 999){+|1} см",
    numericInput: true,
    showMaskOnHover: false,
    showMaskOnFocus: false,
    rightAlign: false,
  })
  $("[data-rate-format]").inputmask({
    mask: "( 999){+|1} %",
    numericInput: true,
    showMaskOnHover: false,
    showMaskOnFocus: false,
    rightAlign: false,
  })
  $("[data-number-format]").inputmask({
    mask: "( 999){+|1}",
    numericInput: true,
    showMaskOnHover: false,
    showMaskOnFocus: false,
    rightAlign: false,
  })

  if ($(".range-slider").length) {
    var rangeSliders = $(".range-slider")
    rangeSliderInit(rangeSliders)
  }

  $('[data-toggle="datepicker"]').datepicker({
    // options here
    autoHide: true,
    autoPick: true,
    format: "dd.mm.yyyy",
    language: "ru-Ru",
    date: Date.now(),
    weekStart: 1,
    days: [
      "Воскресенье",
      "Понедельник",
      "Вторник",
      "Среда",
      "Четверг",
      "Пятница",
      "Суббота",
    ],
    daysShort: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    daysMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
    months: [
      "Январь",
      "Февраль",
      "Март",
      "Апрель",
      "Май",
      "Июнь",
      "Июль",
      "Август",
      "Сентябрь",
      "Октябрь",
      "Ноябрь",
      "Декабрь",
    ],
    monthsShort: [
      "Янв",
      "Фер",
      "Мар",
      "Апр",
      "Май",
      "Июн",
      "Июл",
      "Авг",
      "Сен",
      "Окт",
      "Ноя",
      "Дек",
    ],

    mutedClass: "muted",
    pickedClass: "picked",
    disabledClass: "disabled",
    highlightedClass: "highlighted",
    template:
      '<div class="datepicker-container">' +
      '<div class="datepicker-panel" data-view="years picker">' +
      "<ul>" +
      '<li data-view="years prev">&lsaquo;</li>' +
      '<li data-view="years current"></li>' +
      '<li data-view="years next">&rsaquo;</li>' +
      "</ul>" +
      '<ul data-view="years"></ul>' +
      "</div>" +
      '<div class="datepicker-panel" data-view="months picker">' +
      "<ul>" +
      '<li data-view="year prev">&lsaquo;</li>' +
      '<li data-view="year current"></li>' +
      '<li data-view="year next">&rsaquo;</li>' +
      "</ul>" +
      '<ul data-view="months"></ul>' +
      "</div>" +
      '<div class="datepicker-panel" data-view="days picker">' +
      "<ul>" +
      '<li data-view="month prev">&lsaquo;</li>' +
      '<li data-view="month current"></li>' +
      '<li data-view="month next">&rsaquo;</li>' +
      "</ul>" +
      '<ul data-view="week"></ul>' +
      '<ul data-view="days"></ul>' +
      "</div>" +
      "</div>",
    template:
      '<div class="datepicker-container">' +
      '<div class="datepicker-panel" data-view="years picker">' +
      '<ul class="datepicker-nav">' +
      '<li data-view="month prev">&lsaquo;</li>' +
      '<li data-view="month current"></li>' +
      '<li data-view="month next">&rsaquo;</li>' +
      "</ul>" +
      '<ul data-view="years"></ul>' +
      "</div>" +
      '<div class="datepicker-panel" data-view="months picker">' +
      '<ul class="datepicker-nav">' +
      '<li data-view="month prev">&lsaquo;</li>' +
      '<li data-view="month current"></li>' +
      '<li data-view="month next">&rsaquo;</li>' +
      "</ul>" +
      '<ul data-view="months"></ul>' +
      "</div>" +
      '<div class="datepicker-panel" data-view="days picker">' +
      '<ul class="datepicker-nav">' +
      '<li data-view="month prev">&lsaquo;</li>' +
      '<li data-view="month current"></li>' +
      '<li data-view="month next">&rsaquo;</li>' +
      "</ul>" +
      '<ul data-view="week"></ul>' +
      '<ul data-view="days"></ul>' +
      "</div>" +
      "</div>",
    /*  startDate: Date.now(), */
  })
})

$(document).ready(function () {
  var customSelect = $(".calcform__select")

  customSelect.each(function () {
    var thisCustomSelect = $(this),
      options = thisCustomSelect.find("option"),
      firstOptionText = options.first().text()

    var selectedItem = $("<div></div>", {
      class: "calcform__select-selected",
    })
      .appendTo(thisCustomSelect)
      .text(firstOptionText)

    var allItems = $("<div></div>", {
      class: "calcform__select-all all-items-hide",
    }).appendTo(thisCustomSelect)

    options.each(function () {
      var that = $(this),
        optionText = that.text()

      var item = $("<div></div>", {
        class: "calcform__select-item",
        on: {
          click: function () {
            $(".calcform__select-item").removeClass("active")
            $(this).addClass("active")
            var selectedOptionText = that.text()
            selectedItem.text(selectedOptionText).removeClass("arrowanim")
            allItems.addClass("all-items-hide")
          },
        },
      })
        .appendTo(allItems)
        .text(optionText)
    })
    $(".calcform__select").each((index, item) => {
      console.log(item)
      $(item).find(".calcform__select-item:first").addClass("active")
    })
  })

  var selectedItem = $(".calcform__select-selected"),
    allItems = $(".calcform__select-all")

  selectedItem.on("click", function (e) {
    var currentSelectedItem = $(this),
      currentAllItems = currentSelectedItem.next(".calcform__select-all")

    allItems.not(currentAllItems).addClass("all-items-hide")
    selectedItem.not(currentSelectedItem).removeClass("arrowanim")

    currentAllItems.toggleClass("all-items-hide")
    currentSelectedItem.toggleClass("arrowanim")

    e.stopPropagation()
  })

  $(document).on("click", function () {
    var opened = $(".calcform__select-all:not(.all-items-hide)"),
      index = opened.parent().index()

    customSelect
      .eq(index)
      .find(".calcform__select-all")
      .addClass("all-items-hide")
    customSelect
      .eq(index)
      .find(".calcform__select-selected")
      .removeClass("arrowanim")
  })
})
