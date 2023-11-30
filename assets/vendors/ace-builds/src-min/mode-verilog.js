define("ace/mode/verilog_highlight_rules",["require","exports","module","ace/lib/oop","ace/mode/text_highlight_rules"],function(e,t,n){"use strict";var r=e("lib/oop"),i=e("./text_highlight_rules").TextHighlightRules,s=function(){var e="always|and|assign|automatic|begin|buf|bufif0|bufif1|case|casex|casez|cell|cmos|config|deassign|default|defparam|design|disable|edge|else|end|endcase|endconfig|endfunction|endgenerate|endmodule|endprimitive|endspecify|endtable|endtask|event|for|force|forever|fork|function|generate|genvar|highz0|highz1|if|ifnone|incdir|include|initial|inout|input|instance|integer|join|large|liblist|library|localparam|macromodule|medium|module|nand|negedge|nmos|nor|noshowcancelled|not|notif0|notif1|or|output|parameter|pmos|posedge|primitive|pull0|pull1|pulldown|pullup|pulsestyle_onevent|pulsestyle_ondetect|rcmos|real|realtime|reg|release|repeat|rnmos|rpmos|rtran|rtranif0|rtranif1|scalared|showcancelled|signed|small|specify|specparam|strong0|strong1|supply0|supply1|table|task|time|tran|tranif0|tranif1|tri|tri0|tri1|triand|trior|trireg|unsigned|use|vectored|wait|wand|weak0|weak1|while|wire|wor|xnor|xorbegin|bufif0|bufif1|case|casex|casez|config|else|end|endcase|endconfig|endfunction|endgenerate|endmodule|endprimitive|endspecify|endtable|endtask|for|forever|function|generate|if|ifnone|macromodule|module|primitive|repeat|specify|table|task|while",t="true|false|null",n="count|min|max|avg|sum|rank|now|coalesce|main",r=this.createKeywordMapper({"support.function":n,keyword:e,"constant.language":t},"identifier",!0);this.$rules={start:[{token:"comment",regex:"//.*$"},{token:"comment.start",regex:"/\\*",next:[{token:"comment.end",regex:"\\*/",next:"start"},{defaultToken:"comment"}]},{token:"string.start",regex:'"',next:[{token:"constant.language.escape",regex:/\\(?:[ntvfa\\"]|[0-7]{1,3}|\x[a-fA-F\d]{1,2}|)/,consumeLineEnd:!0},{token:"string.end",regex:'"|$',next:"start"},{defaultToken:"string"}]},{token:"string",regex:"'^[']'"},{token:"constant.numeric",regex:"[+-]?\\d+(?:(?:\\.\\d*)?(?:[eE][+-]?\\d+)?)?\\b"},{token:r,regex:"[a-zA-Z_$][a-zA-Z0-9_$]*\\b"},{token:"keyword.operator",regex:"\\+|\\-|\\/|\\/\\/|%|<@>|@>|<@|&|\\^|~|<|>|<=|=>|==|!=|<>|="},{token:"paren.lparen",regex:"[\\(]"},{token:"paren.rparen",regex:"[\\)]"},{token:"text",regex:"\\s+"}]},this.normalizeRules()};r.inherits(s,i),t.VerilogHighlightRules=s}),define("ace/mode/verilog",["require","exports","module","ace/lib/oop","ace/mode/text","ace/mode/verilog_highlight_rules","ace/range"],function(e,t,n){"use strict";var r=e("lib/oop"),i=e("./text").Mode,s=e("./verilog_highlight_rules").VerilogHighlightRules,o=e("range").Range,u=function(){this.HighlightRules=s,this.$behaviour=this.$defaultBehaviour};r.inherits(u,i),function(){this.lineCommentStart="//",this.blockComment={start:"/*",end:"*/"},this.$quotes={'"':'"'},this.$id="ace/mode/verilog"}.call(u.prototype),t.Mode=u});                (function() {
                    window.require(["ace/mode/verilog"], function(m) {
                        if (typeof module == "object" && typeof exports == "object" && module) {
                            module.exports = m;
                        }
                    });
                })();
            