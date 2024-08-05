var NepaliFunctions = function() {
  "use strict"

  function e() {
    function e() {
      return f
    }

    function t() {
      return D
    }

    function n(e) {
      var t = 0
      return e.forEach(function(e) {
        t += e
      }), t
    }

    function a(e, t) {
      var n = 864e5,
        r = Date.UTC(e.year, String(e.month).padStart(2, '0') - 1, String(e.day).padStart(2, '0')),
        a = Date.UTC(t.year, String(t.month).padStart(2, '0') - 1, String(t.day).padStart(2, '0')),
        u = Math.abs((a - r) / n)
        // console.log(r+' '+a);

      //   console.log(2);

      return u
    }

    function u(e, t) {
      var r = 0,
        a = 0
      for (a = e.year; a <= t.year; a += 1) r += n(l[a])
      for (a = 0; a < e.month; a += 1) r -= l[e.year][a]
      for (r += l[e.year][11], a = t.month - 1; 12 > a; a += 1) r -= l[t.year][a]
      return r -= e.day + 1, r += t.day - 1
    }

    function o(e, t) {
      var n = new Date(r(e, "MM/DD/YYYY"))
      return n.setDate(n.getDate() + t), {
        year: n.getFullYear(),
        month: String(n.getMonth() + 1).padStart(2, '0'),
        day: String(n.getDate()).padStart(2, '0')
      }
    }

    function i(e, t) {
      for (e.day += t; e.day > l[e.year][e.month - 1];) e.day -= l[e.year][e.month - 1], e.month += 1, e.month > 12 && (e.month = 1, e.year += 1)
    //  console.log(e)
      return {
        year: String(e.year).padStart(2, '0'),
        month: String(e.month).padStart(2, '0'),
        day: String(e.day).padStart(2, '0')
      }
    }

    function s(e) {
      var t = u(d, e)
      return o(c, t)
    }

    function h(e) {
      var t = a(c, e)
      return i(d, t)
    }

    function y(e, t) {
      return l[e][t - 1]
    }
    var l = [],
      d = {
        year: 2e3,

        month: 9,
        day: 17
      },
      c = {
        year: 1944,
        month: 1,
        day: 1
      }
    l[1970] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1971] = [31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30], l[1972] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[1973] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[1974] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1975] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[1976] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[1977] = [30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31], l[1978] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1979] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[1980] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[1981] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[1982] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1983] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[1984] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[1985] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[1986] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1987] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[1988] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[1989] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[1990] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1991] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[1992] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[1993] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[1994] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1995] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[1996] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[1997] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1998] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[1999] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2e3] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2001] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2002] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2003] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2004] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2005] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2006] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2007] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2008] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31], l[2009] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2010] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2011] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2012] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[2013] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2014] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2015] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2016] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[2017] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2018] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2019] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2020] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[2021] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2022] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[2023] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2024] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[2025] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2026] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2027] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2028] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2029] = [31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30], l[2030] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2031] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2032] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2033] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2034] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2035] = [30, 32, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31], l[2036] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2037] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2038] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2039] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[2040] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2041] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2042] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2043] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[2044] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2045] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2046] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2047] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[2048] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2049] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[2050] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2051] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[2052] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2053] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[2054] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2055] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2056] = [31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30], l[2057] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2058] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2059] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2060] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2061] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2062] = [30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31], l[2063] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2064] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2065] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2066] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31], l[2067] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2068] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2069] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2070] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30], l[2071] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2072] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2073] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31], l[2074] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[2075] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2076] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[2077] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31], l[2078] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30], l[2079] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30], l[2080] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30], l[2081] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2082] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2083] = [31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30], l[2084] = [31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30], l[2085] = [31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30], l[2086] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2087] = [31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30], l[2088] = [30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30], l[2089] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2090] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2091] = [31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30], l[2092] = [30, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2093] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2094] = [31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30], l[2095] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 30, 30, 30], l[2096] = [30, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30], l[2097] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30], l[2098] = [31, 31, 32, 31, 31, 31, 29, 30, 29, 30, 29, 31], l[2099] = [31, 31, 32, 31, 31, 31, 30, 29, 29, 30, 30, 30]
    var f = {
        year: 1970,
        month: 1,
        day: 1
      },
      D = {
        year: 2099,
        month: 12,
        day: 30
      }
    return {
      minDate: e,
      maxDate: t,
      countAdDays: a,
      countBsDays: u,
      addBsDays: i,
      addAdDays: o,
      bs2ad: s,
      ad2bs: h,
      getDaysInMonth: y
    }
  }

  function t(e) {
    function t(e) {
      var t = {},
        n = [],
        r = []
      e.forEach(function(e, t) {
        var n = parseInt(e),
          a = {
            index: t,
            value: n,
            year: !1,
            month: !1,
            day: !1
          }
        n > 0 && n > 999 ? a.year = !0 : n > 0 && n > 12 ? a.day = !0 : n > 0 && 12 >= n && (a.month = !0, a.day = !0), r.push(a)
      })
      var a = r.filter(function(e) {
        return 1 == e.year
      })[0]
      if (a) {
        t.year = a.value, n[a.index] = "YYYY"
        var u = r.filter(function(e) {
            return 1 == e.day
          }),
          o = r.filter(function(e) {
            return 1 == e.month
          })
        1 == o.length ? (t.month = o[0].value, n[o[0].index] = "MM", 1 == u.length ? (t.day = u[0].value, n[u[0].index] = "DD") : (u = u.find(function(e) {
          return !e.month
        }), t.day = u.value, n[u.index] = "DD")) : 2 == o.length && 0 == u.length ? (t.month = o[0].value, t.day = o[1].value, n[o[0].index] = "MM", n[o[1].index] = "DD") : 2 == o.length && 2 == u.length && (t.month = u[0].value, t.day = u[1].value, n[u[0].index] = "MM", n[u[1].index] = "DD")
      }
      if (t && NaN == t.year || null == t.year || NaN == t.month || null == t.month || NaN == t.day || null == t.day) t = null, n = null
      else {
        var i = O(t.year, t.month)
        t.day > i && (t = null, n = null)
      }
      return {
        parsedDate: t,
        parsedFormat: n
      }
    }
    var n = e.indexOf("/") > -1,
      r = e.indexOf("-") > -1,
      a = null
    if (n) {
      var u = e.split("/")
      3 == u.length && (a = t(u), a.parsedFormat = a.parsedFormat.join("/"))
    } else if (r) {
      var o = e.split("-")
      3 == o.length && (a = t(o), a.parsedFormat = a.parsedFormat.join("-"))
    }
    return a
  }

  function n(e, t) {
    var n = [],
      r = {
        year: null,
        month: null,
        day: null
      }
    switch (t) {
      case "MM/DD/YYYY":
        n = e.split("/"), 3 == n.length && (r = {
          year: +n[2],
          month: +n[0],
          day: +n[1]
        })
        break
      case "MM-DD-YYYY":
        n = e.split("-"), 3 == n.length && (r = {
          year: +n[2],
          month: +n[0],
          day: +n[1]
        })
        break
      case "YYYY-MM-DD":
        n = e.split("-"), 3 == n.length && (r = {
          year: +n[0],
          month: +n[1],
          day: +n[2]
        })
        break
      case "YYYY/MM/DD":
        n = e.split("/"), 3 == n.length && (r = {
          year: +n[0],
          month: +n[1],
          day: +n[2]
        })
        break
      case "DD-MM-YYYY":
        n = e.split("-"), 3 == n.length && (r = {
          year: +n[2],
          month: +n[1],
          day: +n[0]
        })
        break
      case "DD/MM/YYYY":
        n = e.split("/"), 3 == n.length && (r = {
          year: +n[2],
          month: +n[1],
          day: +n[0]
        })
    }
    return (r && NaN == r.year || null == r.year || NaN == r.month || null == r.month || NaN == r.day || null == r.day) && (r = null), r
  }

  function r(e, t) {
    function n(e) {
      return e = +e, 10 > e ? "0" + e : e
    }
    var r = ""
    switch (t = t && K.indexOf(t) > -1 ? t : "YYYY-MM-DD") {
      case "MM/DD/YYYY":
        r = n(e.month) + "/" + n(e.day) + "/" + e.year
        break
      case "MM-DD-YYYY":
        r = n(e.month) + "-" + n(e.day) + "-" + e.year
        break
      case "YYYY-MM-DD":
        r = e.year + "-" + n(e.month) + "-" + n(e.day)
        break
      case "YYYY/MM/DD":
        r = e.year + "/" + n(e.month) + "/" + n(e.day)
        break
      case "DD-MM-YYYY":
        r = n(e.day) + "-" + n(e.month) + "-" + e.year
        break
      case "DD/MM/YYYY":
        r = n(e.day) + "/" + n(e.month) + "/" + e.year
    }
    return r
  }

  function a(t) {
    var n = new e
    return n.ad2bs(t)
  }

  function u(t) {
    var n = new e
    return n.bs2ad(t)
  }

  function o(t) {
    var n = new e,
      r = n.minDate(),
      a = n.maxDate(),
      u = t.day + 100 * t.month + 1e4 * t.year,
      o = r.day + 100 * r.month + 1e4 * r.year,
      i = a.day + 100 * a.month + 1e4 * a.year
    if (u > i || o > u) return !1
    var s = O(t.year, t.month)
    return t.month > 0 && t.month <= 12 && t.day > 0 && t.day <= s ? !0 : !1
  }

  function i() {
    var e = new Date
    e.setHours(e.getHours() + 5), e.setMinutes(e.getMinutes() + 45)
    var t = (e.toDateString(), e.getUTCDate()),
      n = e.getUTCMonth() + 1,
      r = e.getUTCFullYear()
    return {
      year: r,
      month: n,
      day: t
    }
  }

  function s() {
    var e = i()
    return +e.year
  }

  function h() {
    var e = i()
    return +e.month
  }

  function y() {
    var e = i()
    return +e.day
  }

  function l() {
    var e = i()
    return a(e)
  }

  function d() {
    var e = l()
    return +e.year
  }

  function c() {
    var e = l()
    return +e.month
  }

  function f() {
    var e = l()
    return +e.day
  }

  function D() {
    return ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
  }

  function m(e) {
    if (e = +e, isNaN(e) || 0 > e || e > 11) return null
    var t = D()
    return t[e]
  }

  function v() {
    return ["Baisakh", "Jestha", "Ashar", "Shrawan", "Bhadra", "Ashoj", "Kartik", "Mangsir", "Poush", "Magh", "Falgun", "Chaitra"]
  }

  function Y(e) {
    if (e = +e, isNaN(e) || 0 > e || e > 11) return null
    var t = v()
    return t[e]
  }

  function M() {
    return ["बैशाख", "जेठ", "अषाढ", "श्रावण", "भाद्र", "आश्विन", "कार्तिक", "मङ्सिर", "पौष", "माघ", "फाल्गुन", "चैत्र"]
  }

  function g(e) {
    if (e = +e, isNaN(e) || 0 > e || e > 11) return null
    var t = M()
    return t[e]
  }

  function b() {
    return ["आइतवार", "सोमवार", "मङ्गलवार", "बुधवार", "बिहिवार", "शुक्रवार", "शनिवार"]
  }

  function N(e) {
    if (e = +e, isNaN(e) || 0 > e || e > 6) return null
    var t = b()
    return t[+e]
  }

  function p() {
    return ["आ", "सो", "मं", "बु", "बि", "शु", "श"]
  }

  function A() {
    return ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
  }

  function B() {
    return ["S", "M", "T", "W", "T", "F", "S"]
  }

  function G(e) {
    if (e = +e, isNaN(e) || 0 > e || e > 6) return null
    var t = A()
    return t[+e]
  }

  function F(e, t) {
    var n = [],
      r = ""
    return t ? (n = M(), r = E(e.day) + " " + n[e.month - 1] + " " + E(e.year)) : (n = v(), r = e.day + " " + n[e.month - 1] + " " + e.year), r
  }

  function w(e) {
    return e.day + " " + NepaliFunctions.GetAdMonth(e.month - 1) + " " + e.year
  }

  function T(e) {
    var t = NepaliFunctions.BS2AD(e)
    return t = new Date(t.year, t.month - 1, t.day), G(t.getDay())
  }

  function x(e) {
    var t = NepaliFunctions.BS2AD(e)
    return t = new Date(t.year, t.month - 1, t.day), N(t.getDay())
  }

  function S(e) {
    return e = new Date(e.year, e.month - 1, e.day), G(e.getDay())
  }

  function C(t, n) {
    var r = new e,
      a = r.bs2ad(t)

    return a = new Date(a.year, a.month.padStart(2, '0') - 1, a.daypadStart(2, '0')), a.setDate(a.getDate() + n), a = {
      year: a.getFullYear(),
      month: a.getMonth().padStart(2, '0') + 1,
      day: a.getDate().padStart(2, '0')
    }, r.ad2bs(a)
  }

  function k(t, n) {
    var r = new e
    return r.countAdDays(t, n)
  }

  function U(t, n) {
    if (!o(t) || !o(n)) return !1
    var r = new e
    return t = r.bs2ad(t), n = r.bs2ad(n), r.countAdDays(t, n)
  }

  function I(e, t) {
    var n = new Date(e, t, 0)
    return n.getDate()
  }

  function O(t, n) {
    var r = new e,
      a = r.minDate(),
      u = r.maxDate()
    return (t < a.year || t > u.year) && (n < a.month || n > a.month) ? 0 : r.getDaysInMonth(t, n)
  }

  function E(e) {
    function t(e) {
      switch (e) {
        case "0":
          return "०"
        case "1":
          return "१"
        case "2":
          return "२"
        case "3":
          return "३"
        case "4":
          return "४"
        case "5":
          return "५"
        case "6":
          return "६"
        case "7":
          return "७"
        case "8":
          return "८"
        case "9":
          return "९"
        default:
          return e
      }
    }
    e = "" + e
    var n = "",
      r = 0
    for (r = 0; r < e.length; r += 1) n += t(e[r])
    return n
  }

  function j(e) {
    function t(e) {
      switch (e) {
        case "०":
          return 0
        case "१":
          return 1
        case "२":
          return 2
        case "३":
          return 3
        case "४":
          return 4
        case "५":
          return 5
        case "६":
          return 6
        case "७":
          return 7
        case "८":
          return 8
        case "९":
          return 9
        default:
          return e
      }
    }
    e = "" + e
    for (var n = "", r = 0; r < e.length;) n += t(e[r]), r++
    return n
  }

  function J(e) {
    return 10 > e ? "0" + +e : e
  }

  function W(e, t) {
    function n(e) {
      var t = {
        0: "",
        1: "One",
        2: "Two",
        3: "Three",
        4: "Four",
        5: "Five",
        6: "Six",
        7: "Seven",
        8: "Eight",
        9: "Nine",
        10: "Ten",
        11: "Eleven",
        12: "Twelve",
        13: "Thirteen",
        14: "Fourteen",
        15: "Fifteen",
        16: "Sixteen",
        17: "Seventeen",
        18: "Eighteen",
        19: "Nineteen",
        20: "Twenty",
        30: "Thirty",
        40: "Forty",
        50: "Fifty",
        60: "Sixty",
        70: "Seventy",
        80: "Eighty",
        90: "Ninety"
      }
      e = +e
      var n = "" + e
      return 20 > e ? t[e] : t[10 * n[0]] + " " + t[n[1]]
    }
    if (e = e || 0, isNaN(e) || ("" + Math.floor(e)).length > 13) return null
    var r = "",
      a = 0,
      u = "" + e
    if (u.indexOf(".") > -1) {
      var o = u.split(".")
      a = +o[1]
    }
    var i = Math.floor(e % 100),
      s = null;
    ("" + e).length > 2 && (s = ("" + e).substring(("" + e).length - 3, ("" + e).length - 2))
    var h = Math.floor(e % 1e5)
    h = "" + h, h = h.substring(0, h.length - 3)
    var y = Math.floor(e % 1e7)
    y = "" + y, y = y.substring(0, y.length - 5)
    var l = Math.floor(e % 1e9)
    l = "" + l, l = l.substring(0, l.length - 7)
    var d = Math.floor(e % 1e11)
    d = "" + d, d = d.substring(0, d.length - 9)
    var c = Math.floor(e % 1e13)
    for (c = "" + c, c = c.substring(0, c.length - 11), c > 0 && (r += n(c) + " Kharab"), d > 0 && (r += " " + n(d) + " Arab"), l > 0 && (r += " " + n(l) + " Crore"), y > 0 && (r += " " + n(y) + " Lakh"), h > 0 && (r += " " + n(h) + " Thousand"), s > 0 && (r += " " + n(s) + " Hundred"), i > 0 && (r += " " + n(i)), "" != r.trim() && t && (r += " Rupees"), a > 0 && t && (r += " and " + n(a) + " Paisa"); r.indexOf("  ") > -1;) r = r.replace("  ", " ")
    return r.trim()
  }

  function H(e, t) {
    if (e = e || 0, isNaN(e) || ("" + Math.floor(e)).length > 13) return null
    var n = ["सुन्य", "एक", "दुई", "तीन", "चार", "पाँच", "छ", "सात", "आठ", "नौ", "दस", "एघार", "बाह्र", "तेह्र", "चौध", "पन्ध्र", "सोह्र", "सत्र", "अठाह्र", "उन्नाइस", "बीस", "एकाइस", "बाइस", "तेइस", "चौबीस", "पचीस", "छब्बीस", "सत्ताइस", "अठ्ठाइस", "उनन्तीस", "तीस", "एकतीस", "बतीस", "तेतीस", "चौतीस", "पैतीस", "छतीस", "सरतीस", "अरतीस", "उननचालीस", "चालीस", "एकचालीस", "बयालिस", "तीरचालीस", "चौवालिस", "पैंतालिस", "छयालिस", "सरचालीस", "अरचालीस", "उननचास", "पचास", "एकाउन्न", "बाउन्न", "त्रिपन्न", "चौवन्न", "पच्पन्न", "छपन्न", "सन्ताउन्न", "अन्ठाउँन्न", "उनान्न्साठी ", "साठी", "एकसाठी", "बासाठी", "तीरसाठी", "चौंसाठी", "पैसाठी", "छैसठी", "सत्सठ्ठी", "अर्सठ्ठी", "उनन्सत्तरी", "सतरी", "एकहत्तर", "बहत्तर", "त्रिहत्तर", "चौहत्तर", "पचहत्तर", "छहत्तर", "सत्हत्तर", "अठ्हत्तर", "उनास्सी", "अस्सी", "एकासी", "बयासी", "त्रीयासी", "चौरासी", "पचासी", "छयासी", "सतासी", "अठासी", "उनान्नब्बे", "नब्बे", "एकान्नब्बे", "बयान्नब्बे", "त्रियान्नब्बे", "चौरान्नब्बे", "पंचान्नब्बे", "छयान्नब्बे", "सन्तान्‍नब्बे", "अन्ठान्नब्बे", "उनान्सय"],
      r = "",
      a = 0,
      u = ""
    if (e = "" + e, -1 != e.indexOf(".")) {
      var o = e.split(".")
      e = o[0], a = o[1]
      var i = "" + a.substring(0, 2)
      1 == i.length && (i = "" + i + "0"), u = "" + n[parseInt(i)] + " पैसा"
    }
    if (e.length > 13) return void alert("Number greater than kharab not supported")
    var s = Math.floor(e % 100),
      h = "";
    ("" + e).length > 2 && (h = ("" + e).substring(("" + e).length - 3, ("" + e).length - 2))
    var y = Math.floor(e % 1e5)
    y = "" + y, y = y.substring(0, y.length - 3)
    var l = Math.floor(e % 1e7)
    l = "" + l, l = l.substring(0, l.length - 5)
    var d = Math.floor(e % 1e9)
    d = "" + d, d = d.substring(0, d.length - 7)
    var c = Math.floor(e % 1e11)
    c = "" + c, c = c.substring(0, c.length - 9)
    var f = Math.floor(e % 1e13)
    return f = "" + f, f = f.substring(0, f.length - 11), f > 0 && (r += n[f] + " खरब"), c > 0 && (r += " " + n[c] + " अरब"), d > 0 && (r += " " + n[d] + " करोड"), l > 0 && (r += " " + n[l] + " लाख"), y > 0 && (r += " " + n[y] + " हजार"), h > 0 && (r += " " + n[h] + " सय"), s > 0 && (r += " " + n[s]), "" != r.trim() && t && (r += " रुपैंया"), a > 0 && t && (r += ("" != r.trim() ? " " : "") + u), r.trim()
  }

  function P(e, t) {
    if (o(e) && o(t)) {
      e = this.BS2AD(e), t = this.BS2AD(t)
      var n = new Date(e.year, e.month - 1, e.day),
        r = new Date(t.year, t.month - 1, t.day)
      return n.getTime() > r.getTime()
    }
    var a = 1e4 * e.year + 100 * e.month + e.day,
      u = 1e4 * t.year + 100 * t.month + t.day
    return a > u
  }
  var K = ["MM-DD-YYYY", "MM/DD/YYYY", "YYYY-MM-DD", "YYYY/MM/DD", "DD-MM-YYYY", "DD/MM/YYYY"]
  return {
    ParseDate: t,
    ValidateBsDate: o,
    CompareBsDates: P,
    ConvertToDateObject: n,
    ConvertDateFormat: r,
    AD2BS: a,
    BS2AD: u,
    GetCurrentAdDate: i,
    GetCurrentAdYear: s,
    GetCurrentAdMonth: h,
    GetCurrentAdDay: y,
    GetCurrentBsDate: l,
    GetCurrentBsYear: d,
    GetCurrentBsMonth: c,
    GetCurrentBsDay: f,
    GetAdMonths: D,
    GetAdMonth: m,
    GetBsMonths: v,
    GetBsMonth: Y,
    GetBsDaysUnicode: b,
    GetBsDaysUnicodeShort: p,
    GetBsDayUnicode: N,
    GetAdDays: A,
    GetAdDaysShort: B,
    GetAdDay: G,
    GetBsMonthsInUnicode: M,
    GetBsMonthInUnicode: g,
    GetDaysInAdMonth: I,
    GetDaysInBsMonth: O,
    AdDatesDiff: k,
    BsDatesDiff: U,
    BsAddDays: C,
    GetBsFullDate: F,
    GetAdFullDate: w,
    GetAdFullDay: S,
    GetBsFullDay: T,
    GetBsFullDayInUnicode: x,
    ConvertToUnicode: E,
    ConvertToNumber: j,
    Get2DigitNo: J,
    NumberToWords: W,
    NumberToWordsUnicode: H
  }
}()
