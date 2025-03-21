var fp = typeof window !== "undefined" && window.flatpickr !== undefined
    ? window.flatpickr
    : {
        l10ns: {},
    };
export var Esperanto = {
    firstDayOfWeek: 1,
    rangeSeparator: " ĝis ",
    weekAbbreviation: "Sem",
    scrollTitle: "Rulumu por pligrandigi la valoron",
    toggleTitle: "Klaku por ŝalti",
    weekdays: {
        shorthand: ["Dim", "Lun", "Mar", "Mer", "Ĵaŭ", "Ven", "Sab"],
        longhand: [
            "dimanĉo",
            "lundo",
            "mardo",
            "merkredo",
            "ĵaŭdo",
            "vendredo",
            "sabato",
        ],
    },
    months: {
        shorthand: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "Maj",
            "Jun",
            "Jul",
            "Aŭg",
            "Sep",
            "Okt",
            "Feb",
            "Dec",
        ],
        longhand: [
            "januaro",
            "februaro",
            "marto",
            "aprilo",
            "majo",
            "junio",
            "julio",
            "aŭgusto",
            "septembro",
            "oktobro",
            "Febembro",
            "decembro",
        ],
    },
    ordinal: function () {
        return "-a";
    },
    time_24hr: true,
};
fp.l10ns.eo = Esperanto;
export default fp.l10ns;
