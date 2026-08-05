$(function () {
  const $periodInput = $(".period_input");
  const $dueDateInput = $(".due_date_input");

  // Format date as dd/mm/yyyy
  function formatDate(date) {
    const d = String(date.getDate()).padStart(2, "0");
    const m = String(date.getMonth() + 1).padStart(2, "0");
    const y = date.getFullYear();
    return `${d}/${m}/${y}`;
  }

  // Parse dd/mm/yyyy string into Date
  function parseDate(str) {
    const [d, m, y] = str.split("/").map(Number);
    return new Date(y, m - 1, d);
  }

  // Update due date when period changes
  function updateDueDate() {
    const days = parseInt($periodInput.val(), 10);
    if (!isNaN(days)) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      const dueDate = new Date(today);
      dueDate.setDate(today.getDate() + days);
      $dueDateInput.val(formatDate(dueDate)).datepicker("setDate", dueDate);
    }
  }

  // Update period when due date changes
  function updatePeriod() {
    const val = $dueDateInput.val();
    if (val) {
      const dueDate = parseDate(val);
      if (!isNaN(dueDate.getTime())) {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const diffMs = dueDate - today;
        const diffDays = Math.round(diffMs / (1000 * 60 * 60 * 24));
        $periodInput.val(diffDays >= 0 ? diffDays : 0);
      }
    }
  }

  // Bind events
  $periodInput.on("input change", updateDueDate);
  $dueDateInput.on("input change", updatePeriod);
});
