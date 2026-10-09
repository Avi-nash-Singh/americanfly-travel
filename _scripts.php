    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- jQuery UI for Datepicker -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <!-- Bootstrap 5 JS Bundle -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <!-- Slick Slider  -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
      integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!-- Custom Script -->
    <script src="script.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
      $(document).ready(function () {
        // 1. Initialize Select2 on Origin and Destination
        $(".bs-select2-origin, .bs-select2-destination").select2({
          dropdownAutoWidth: true,
          width: "100%",
        });

        // 2. Initialize Modern Flatpickr Datepickers
        const today = new Date();
        const returnDay = new Date();
        returnDay.setDate(today.getDate() + 7);

        const returnDatePicker = flatpickr("#bsReturnDate", {
          dateFormat: "D, d M Y",
          defaultDate: returnDay,
          minDate: "today",
          disableMobile: true,
        });

        flatpickr("#bsStartDate", {
          dateFormat: "D, d M Y",
          defaultDate: today,
          minDate: "today",
          disableMobile: true,
          onChange: function (selectedDates) {
            if (selectedDates[0]) {
              returnDatePicker.set("minDate", selectedDates[0]);
            }
          },
        });
      });
    </script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
      (function () {
        var s1 = document.createElement("script"),
          s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = "https://embed.tawk.to/66cd98b5ea492f34bc0a8992/1i69hp1jq";
        s1.charset = "UTF-8";
        s1.setAttribute("crossorigin", "*");
        s0.parentNode.insertBefore(s1, s0);
      })();
    </script>
    <!--End of Tawk.to Script-->