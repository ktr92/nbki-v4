var rangeTimeout

function rangeSliderCreate(slideIndex, slide) {
  var rangeSliderOptions
  var rangeSliderType = $(slide).attr("data-range-slider-type")
  var rangeSliderStart = parseFloat($(slide).find(".form-control").val())
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
        "30%": [100000, 1000],
        "70%": [1000000, 10000],
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
      start: [1],
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
      rangeSliderType === "calc_summ" ||
      rangeSliderType === "size" ||
      rangeSliderType === "height" ||
      rangeSliderType === "count"
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
      $(this).closest(".range-slider").attr("data-range-slider-type") ===
      "calc_summ"
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

      if (
        parseInt(
          $('[name="max_calc_summ"]')
            .val()
            .replace(/[^0-9]/g, "")
        ) >
        parseInt(
          $('[name="calc_summ"]')
            .val()
            .replace(/[^0-9]/g, "")
        )
      ) {
        $('[name="calc_summ"]').val($('[name="max_calc_summ"]').val())
        $('[name="calc_summ"]')
          .next()
          .data("slider")
          .set(parseInt(this.value.replace(/[^0-9]/g, "")))
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

  if ($(".range-slider").length) {
    var rangeSliders = $(".range-slider")
    rangeSliderInit(rangeSliders)
  }
})
