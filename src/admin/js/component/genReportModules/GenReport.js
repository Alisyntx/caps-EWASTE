class genReport {
    constructor(rcyReportBtn, reportType = 'mostly') {
        this.rcyReportBtn = rcyReportBtn;
        this.reportType = reportType;
        this.bindEvents();
    }

    bindEvents() {
        $(document).on('click', this.rcyReportBtn, (e) => this.createReport(e));
    }

    createReport(e) {
        e.preventDefault();

        // Open the report page with the specified type
        const printWindow = window.open(`createReports.php?type=${this.reportType}`, '_blank');

        // Wait for the new window to load, then trigger the print dialog
        printWindow.addEventListener('load', function() {
            printWindow.print();
        });
    }
}

export default genReport;
