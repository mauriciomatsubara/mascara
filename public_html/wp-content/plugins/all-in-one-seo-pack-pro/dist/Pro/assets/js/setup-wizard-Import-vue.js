(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["setup-wizard-Import-vue"],{"257e1":function(t,e,s){"use strict";var n=s("e9a2"),i=s.n(n);i.a},"2ba9":function(t,e,s){"use strict";s.r(e);var n=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-wizard-import"},[s("wizard-header"),s("wizard-container",[s("wizard-body",{scopedSlots:t._u([{key:"footer",fn:function(){return[s("div",{staticClass:"go-back"},[s("router-link",{staticClass:"no-underline",attrs:{to:t.getPrevLink}},[t._v("←")]),t._v(" "),s("router-link",{attrs:{to:t.getPrevLink}},[t._v(t._s(t.strings.goBack))])],1),s("div",{staticClass:"spacer"}),s("base-button",{attrs:{type:"gray",tag:"router-link",to:t.getNextLink}},[t._v(t._s(t.strings.skipThisStep))]),s("base-button",{attrs:{type:"blue",loading:t.loading},on:{click:t.saveAndContinue}},[t._v(t._s(t.strings.importDataAndContinue)+" →")])]},proxy:!0}])},[s("wizard-steps"),s("div",{staticClass:"header"},[t._v(" "+t._s(t.strings.importData)+" ")]),s("div",{staticClass:"description"},[t._v(t._s(t.strings.weHaveDetected))]),s("div",{staticClass:"plugins"},[s("grid-row",t._l(t.getPlugins,(function(e,n){return s("grid-column",{key:n,attrs:{md:"6"}},[s("base-highlight-toggle",{attrs:{type:"checkbox",round:"",active:t.isActive(e),name:e.name,value:t.getValue(e)},on:{input:function(s){return t.updateValue(s,e)}}},[t.pluginImages[e.slug]?s("img",{staticClass:"icon",attrs:{src:t.pluginImages[e.slug]}}):t._e(),t.pluginImages[e.slug]?t._e():s("span",{staticClass:"icon dashicons dashicons-admin-plugins"}),t._v(" "+t._s(e.name)+" ")])],1)})),1)],1)],1),s("wizard-close-and-exit")],1)],1)},i=[],a=(s("4de4"),s("c740"),s("caad"),s("d81d"),s("2532"),s("5530")),r=s("9c0e"),o=s("2f62"),u={mixins:[r["p"]],data:function(){return{loading:!1,stage:"import",strings:{importData:this.$t.__("Import data from your current plugins",this.$td),weHaveDetected:this.$t.sprintf(this.$t.__("We have detected other SEO plugins installed on your website. Select which plugins you would like to import data to %1$s.",this.$td),"AIOSEO"),importDataAndContinue:this.$t.__("Import Data and Continue",this.$td)},pluginImages:{"yoast-seo":s("706e"),"yoast-seo-premium":s("706e"),"rank-math-seo":s("f4e2")},selected:[]}},watch:{selected:function(t){this.updateImporters(t.map((function(t){return t.slug})))}},computed:{getPlugins:function(){return this.$aioseo.importers.filter((function(t){return t.canImport}))}},methods:Object(a["a"])(Object(a["a"])(Object(a["a"])({},Object(o["d"])("wizard",["updateImporters"])),Object(o["b"])("wizard",["saveWizard"])),{},{updateValue:function(t,e){if(t)this.selected.push(e);else{var s=this.selected.findIndex((function(t){return t.value===e.value}));-1!==s&&this.$delete(this.selected,s)}},getValue:function(t){return this.selected.includes(t)},isActive:function(t){var e=this.selected.findIndex((function(e){return e.slug===t.slug}));return-1!==e},saveAndContinue:function(){var t=this;this.loading=!0,this.saveWizard("importers").then((function(){t.$router.push(t.getNextLink)}))}})},d=u,g=(s("257e1"),s("2877")),l=Object(g["a"])(d,n,i,!1,null,null,null);e["default"]=l.exports},"706e":function(t,e,s){t.exports=s.p+"img/yoast-logo-small.png"},e9a2:function(t,e,s){},f4e2:function(t,e){t.exports="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJAAAACQCAYAAADnRuK4AAAACXBIWXMAACxLAAAsSwGlPZapAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAzKSURBVHgB7d0LfFPVHQfw/zk3SYGWdjw+m/CZjznckA9g27QgPmbZ1mfSwpxuQ6ciIioCCirTfRQr4pSHo7QVBfrSbRXFqfRBKfNRFMRC2qaFdT6qTj9un6F+FOi7yT1n/9sSDEVokpukSfl/Px9Ibm7uTXLzu+eec+7pDQAhhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYSQAGBAfLJgQdkINWr4T8HhAP8ywjHV8OG2jTPbIAwYgPjEYTJkcqfYCkwB/xIQbey5Cu+8BWGAA/EJ41xCgDAhA7Zuf6MAEV0oQEQXChDRhQJEdKEAEV0oQEQXChDRhQJEdKEAEV0oQEQXChDRhQJEdKEAEV0oQEQXChDRhQJEdBmyIxJvWbzrNmBiGPiZkMJenJexG0ivoTuklck/4n/ngZ9xUDbhDQXoODqEeUkAcUcBIrpQgIguFCCiCwWI6EIBIrpQgIguFCCiCwWI6EIBIrpQgIguFCCiCwWI6EIBIrpQgIguFCCiCwWI6DIoIxLnL/7HpQLEIvAzbW9QFb6iOCf5YyBBMSgBUrlzApf8evAz7cqU0tmzGkjQ0CGM6EIBOoskJSUZrr32Wr9e2JouNB6GzOZfxuBNjMpNoxXORglVjmaCjQHOYqRkUXggj5IMRjFgMYzJSCnlSAAWdawNoo60dtyPy24DP6EAhQmz2TpWMHgbw3GuABaBDxkYVvqEqs1lIF3HEtZ3jfK+37CQ0HfJ8hO/aPG/ns72KvAjOoSFibq6iq8wHKUYhkjwccdnDP7W3Fzj19/goACFke72EeuxUPkMfCNUDpvAzyhAYaS5eVubALkOfCCBldtrKz4EP6MAhZmuYUdKsF7zDXiJMfZnCAAKUJh5f+/eVsbEXd4sg62xhpjIY+9AAFCAwszUqSnfB8Yt3iyDDbVnampqnBAA1IwPI2Zz6jjBjG9ghWaiF4t1GaT8KwQIlUAhSHJ2yk+Rxk63ZkhufB/vehMexDdiF0AHBAiVQCEGk1PRKVS7a3rChPSI6NHKo1KF+7z+GUMGquTiGQigoRIgBwgoxa78wyZuOgphCFtWEltKSwtyUza4Hps8eda5xuHiBSnkDPCFhJcC0XR3F9YBwr3ViRv+NSbF6pZDtXtqarJxWrLNub2zA1JpDAx2WAh5d8lTKVtdjyQmZiY6pfNZjNXF4CMhRMDqPi7hGqBu3GXfkAp/rGB98ju4554o3V33FQEWJ2fLGYjroO/cUYhie7CVNK/kqdTeksJsNhslG7/IIcUj2PweOdDSuAN9iHtSG+5McSetFeDjUdEdOyHAwqoSzfpKlXLcaj/76OC7WYU5KXvdwoOz5YnK5+b81PeKclPmMe6Mw1KphGmhCzlincqNmSW5Kb3hudh8NbayxhUIKdd5Eh5UFmHgVwqhLnSdNnXBqbWBarq7C58SSMp9ToUvLF6f3Ohe4mji4jLOB65sAGYdJ1nmIvuB8gOueQU51n/hzc1zF1WvVjjD0wDSqz6UAME6m5xbkJf2vOuzxMVljWesZydOTDm1DXYqfMraLGvC/dnZ2dplGw/HJVhfxNvfHp/bqTq6/wJBEPIlEO5Ju/E/a2Fe2mUlOSl29/DExlovik2wbJKcf4xnqmfhhpvGpKyNTbBWxyZaLgO3cQwlWCIV5qZYValihVRi0S4H63qZnwjJkgvz00pPhCchMx1bS4e08Ay0MAPZhSXXNfW2iuXHw9P3uJBrobfPUNtmoripaVc7BEHoBojBPqY6U4ryUpMwPJXus2KnJ18Ul2jdwgyyGYv6BbjHun8ObQdOYZLtxnCVJyRYp7kvW5KX8W5hblo6qGymZLIa+oZSBwW+UIXJ4TAX56W4LhPM4hMsq3DODnzTozxYxXvCqV7cYNvx9/4z6usr63BbPAfapaydfCMEScgdwnCnrMY6wKqiDel7+s+Li0ufBIqSLVV5DfSWLmcs6w24QS24S2ZgiYRfmPqg3Va11zWz8KnUt/DmrflLqs34BWbj2ep0nPbrcE83KpZ3D543dt8aV6kxceKvxgyPdFRgqC71aA0SCmJGtt1xpnqNk8Oj2HgY29hY/k8IktAJEAObUNV1xfkZL/SfFRubdgEG50580hKcNDHwoJLgtmZ8dhJmY3es2bqVm3h2/b6yFtfMgtzUOrzJvPXu6nShspV4KEwAP8JD8Bf4Bu4qyk890USfarbGK+Aox48xfqDlcdlW3KFW2OsqNpwYbngaTfvLP7niCstNEESDegjTOs/wRvsC56hHTVf2D49WOcbKYR4zGPZjfeFe3OAm8J2CX8b10qEejDVbirX6k/vMLTmpVR+NMc7Ad5SFgbODH2DQDxpMcFVh7rfhMSdmLlQYvOZJeHDjfI4lY6bdVpkzUHhc9uyp9Hqohx6DVgJhg7uWc7GmxT6srKZm5knF8hSzdaKRwZ24kW/CkHnSnPUCG4ZBmouf/PdYIr3ADMqfGmq3N2tzarJnOmuwmwAPM5WffjMjA7+yBzFM08FL2o6Bp7M2ibbO5QVFs1q1x3rHNIN8Qkgxr69QHHAdrzBhWtrQ8PKnEMIGJUDGTkN5RIRjW15exkl9M2bz7B8L5ry3t6TQghPY6q1Bex1QxdVYId8ugK1qPNBXdzheT6lIypY7f/TlrjSmsBXY+kn0cL1f486xDE9JPOt6ID7eYlaZ1hfFJg+8uOzA9DzedlSubWl5OQT7rk7mVWUiUC6/PGtke7dYhm9mGU5Gg/c6MHBbcMf+Ar9orCsNfHj4Dkdxa+Q5OM8/VFt22H3G0qUvDj/mGHkznmtbjk3wncV5qbfPW7LzNxiI/vW1L7Eb4dfYv/O264H4+LRUyQ1FHr0nCe3YHr8VW1nPQ5gY1ABNmpQ6OmKEYTlWxW7Drfc98F4HfoLcVq4+3lJbdaxvnUlREVFRC7Axex9+vHPAWxKOAONFquJY31Rb9bn7rBtueC5SiRl3YUl+8sFTA8ReV4xdv9v8ZNZX2hSWYvzVCtsKXN9D/boZTvfCdjyRd+PBuh0HIYwMSoCmT0+P7nYY/sC4XIqTw8Fb2pfM4Znudsfa5ubqr7/rKVOmWEYpJpiDX/Jy/JTng/eO4Os8rTqMOU1Nr3zRf+aNi3dOMzKmnay8AEu9J7ZsSH3YvVcZDKIIl0/18LWKuITFgRy3EyhBDZBWkVQlLGIcsHSAEeA11olfVn5X1PCVzTXbPPr7pqkpKZH8G9N8PLSsxOV9OTzia0JhV0fbA/3/pio7+03Df7/qmaCdd3M9dskl1mnMCGW4zA8GWrHWqyylsqyhruxpCFNBCdCkGXio6jHOxZ7f27BE+Al4Cd9kKzZsSrGXb43NVunTpVt6SwWuLsHDyR3ShyBhHes/2LJ6Ujhbi+32miPf8RSGpySwhSWfwPtjPVjj51wRt9TVVu2CMBbQAGkDwLnRNIdjqwTLdq9/PRC/NG2PL2RC3dzQUNUMfjApMeOcYUK5BwN5M376MeA97JuBvJ6Oto2uEql3B3EYH8O7t3u0BgnVqkGd37+OFY4CEqDeQxWTC/B81GJ8BV8qsl/iW9uqKrBe612FAOgNt8l4F5aIC3HS6wq81smHVZ4tEngVl3KT7Dce5zRLObED7JHWo+9hE70l5JvonvBzgCS7JDFzLlYlV+KKfwje084ml0qnYYXd/uq/IQjiLs8aL7vFKkzEdXh482XgmdYJ6kl/mlZBvqnBVvESDCF+CZB23ZmjrZG3YivkAdwTzwVvSQR8m2Di0SZb5SEYBFMTLJMVrcUGoJ2o9b5leEbyAy4N19TVbQ+rJron/BIgrDzW4Ea6CryGRTpjJUx1rK6vr26BEIDN/wsNw/gDUsgbfCyRTsagVO3uWRCs8TnB5p8AJVrW4dHrHo8X0Aoc4IVCUdc27t/xAYSg+BmpE2SP4X4M+BzwqctBduH5kDsbbZVFMIT5JUCT47OmGrloHPiZWiUSXsc60mPR0e37gjFmVx/JYhNnz+BSfRgzn6yN2Pdwwc+kwpbYa8u3wxDnt0o0ntn+ADfvRaeZjR1m7DUF5Oq6uvK9ng5NCCXx8ZmXSi4fwrspcIZKM36wNwXvuaVp/66AtB5Djd/GA3EFSk95UEIP/vcyvsrPZ2eaZ2FX/Z5wDI+mvr78XWxBWfCUw0xtqAX+O3lMtZTd+MHWdLbyWWdLeDT+K4ESZ8cy6WxwTWORX2lgykM2W1kDDEFT4i1mA2faNal/gf+OCQFzG+srXoGzjF/7geLM1kYsYFpxL33cZqvY0f/Pb4YgFpuQkYVb8VP7gR1+GcV4Vus930QIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEEIIIYQQQgghhBBCCCGEEL3+D4/thh0XoaheAAAAAElFTkSuQmCC"}}]);