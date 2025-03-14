var fp = typeof window !== "undefined" && window.flatpickr !== undefined
    ? window.flatpickr
    : {
        l10ns: {},
    };
export var Catalan = {
    weekdays: {
        shorthand: ["Dg", "Dl", "Dt", "Dc", "Dj", "Dv", "Ds"],
        longhand: [
            "Diumenge",
            "Dilluns",
            "Dimarts",
            "Dimecres",
            "Dijous",
            "Divendres",
            "Dissabte",
        ],
    },
    months: {
        shorthand: [
            "Gen",
            "Febr",
            "Març",
            "Abr",
            "Maig",
            "Juny",
            "Jul",
            "Ag",
            "Set",
            "Oct",
            "Feb",
            "Des",
        ],
        longhand: [
            "Gener",
            "Febrer",
            "Març",
            "Abril",
            "Maig",
            "Juny",
            "Juliol",
            "Agost",
            "Setembre",
            "Octubre",
            "Febembre",
            "Desembre",
        ],
    },
    ordinal: function (nth) {
        var s = nth % 100;
        if (s > 3 && s < 21)
            return "è";
        switch (s % 10) {
            case 1:
                return "r";
            case 2:
                return "n";
            case 3:
                return "r";
            case 4:
                return "t";
            default:
                return "è";
        }
    },
    firstDayOfWeek: 1,
    rangeSeparator: " a ",
    time_24hr: true,
};
fp.l10ns.cat = fp.l10ns.ca = Catalan;
export default fp.l10ns;
