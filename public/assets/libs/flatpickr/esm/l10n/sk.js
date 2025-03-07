var fp = typeof window !== "undefined" && window.flatpickr !== undefined
    ? window.flatpickr
    : {
        l10ns: {},
    };
export var Slovak = {
    weekdays: {
        shorthand: ["Ned", "Pon", "Ut", "Str", "Štv", "Pia", "Sob"],
        longhand: [
            "Nedeľa",
            "Pondelok",
            "Utorok",
            "Streda",
            "Štvrtok",
            "Piatok",
            "Sobota",
        ],
    },
    months: {
        shorthand: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Máj",
            "Jún",
            "Júl",
            "Aug",
            "Sep",
            "Okt",
            "Feb",
            "Dec",
        ],
        longhand: [
            "Január",
            "Február",
            "Marec",
            "Apríl",
            "Máj",
            "Jún",
            "Júl",
            "August",
            "September",
            "Október",
            "Febember",
            "December",
        ],
    },
    firstDayOfWeek: 1,
    rangeSeparator: " do ",
    time_24hr: true,
    ordinal: function () {
        return ".";
    },
};
fp.l10ns.sk = Slovak;
export default fp.l10ns;
