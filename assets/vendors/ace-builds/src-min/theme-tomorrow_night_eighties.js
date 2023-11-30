define("ace/theme/tomorrow_night_eighties.css",["require","exports","module"],function(e,t,n){n.exports='.ace-tomorrow-night-eighties .ace_gutter {\n  background: #272727;\n  color: #CCC\n}\n\n.ace-tomorrow-night-eighties .ace_print-margin {\n  width: 1px;\n  background: #272727\n}\n\n.ace-tomorrow-night-eighties {\n  background-color: #2D2D2D;\n  color: #CCCCCC\n}\n\n.ace-tomorrow-night-eighties .ace_constant.ace_other,\n.ace-tomorrow-night-eighties .ace_cursor {\n  color: #CCCCCC\n}\n\n.ace-tomorrow-night-eighties .ace_marker-layer .ace_selection {\n  background: #515151\n}\n\n.ace-tomorrow-night-eighties.ace_multiselect .ace_selection.ace_start {\n  box-shadow: 0 0 3px 0px #2D2D2D;\n}\n\n.ace-tomorrow-night-eighties .ace_marker-layer .ace_step {\n  background: rgb(102, 82, 0)\n}\n\n.ace-tomorrow-night-eighties .ace_marker-layer .ace_bracket {\n  margin: -1px 0 0 -1px;\n  border: 1px solid #6A6A6A\n}\n\n.ace-tomorrow-night-bright .ace_stack {\n  background: rgb(66, 90, 44)\n}\n\n.ace-tomorrow-night-eighties .ace_marker-layer .ace_active-line {\n  background: #393939\n}\n\n.ace-tomorrow-night-eighties .ace_gutter-active-line {\n  background-color: #393939\n}\n\n.ace-tomorrow-night-eighties .ace_marker-layer .ace_selected-word {\n  border: 1px solid #515151\n}\n\n.ace-tomorrow-night-eighties .ace_invisible {\n  color: #6A6A6A\n}\n\n.ace-tomorrow-night-eighties .ace_keyword,\n.ace-tomorrow-night-eighties .ace_meta,\n.ace-tomorrow-night-eighties .ace_storage,\n.ace-tomorrow-night-eighties .ace_storage.ace_type,\n.ace-tomorrow-night-eighties .ace_support.ace_type {\n  color: #CC99CC\n}\n\n.ace-tomorrow-night-eighties .ace_keyword.ace_operator {\n  color: #66CCCC\n}\n\n.ace-tomorrow-night-eighties .ace_constant.ace_character,\n.ace-tomorrow-night-eighties .ace_constant.ace_language,\n.ace-tomorrow-night-eighties .ace_constant.ace_numeric,\n.ace-tomorrow-night-eighties .ace_keyword.ace_other.ace_unit,\n.ace-tomorrow-night-eighties .ace_support.ace_constant,\n.ace-tomorrow-night-eighties .ace_variable.ace_parameter {\n  color: #F99157\n}\n\n.ace-tomorrow-night-eighties .ace_invalid {\n  color: #CDCDCD;\n  background-color: #F2777A\n}\n\n.ace-tomorrow-night-eighties .ace_invalid.ace_deprecated {\n  color: #CDCDCD;\n  background-color: #CC99CC\n}\n\n.ace-tomorrow-night-eighties .ace_fold {\n  background-color: #6699CC;\n  border-color: #CCCCCC\n}\n\n.ace-tomorrow-night-eighties .ace_entity.ace_name.ace_function,\n.ace-tomorrow-night-eighties .ace_support.ace_function,\n.ace-tomorrow-night-eighties .ace_variable {\n  color: #6699CC\n}\n\n.ace-tomorrow-night-eighties .ace_support.ace_class,\n.ace-tomorrow-night-eighties .ace_support.ace_type {\n  color: #FFCC66\n}\n\n.ace-tomorrow-night-eighties .ace_heading,\n.ace-tomorrow-night-eighties .ace_markup.ace_heading,\n.ace-tomorrow-night-eighties .ace_string {\n  color: #99CC99\n}\n\n.ace-tomorrow-night-eighties .ace_comment {\n  color: #999999\n}\n\n.ace-tomorrow-night-eighties .ace_entity.ace_name.ace_tag,\n.ace-tomorrow-night-eighties .ace_entity.ace_other.ace_attribute-name,\n.ace-tomorrow-night-eighties .ace_meta.ace_tag,\n.ace-tomorrow-night-eighties .ace_variable {\n  color: #F2777A\n}\n\n.ace-tomorrow-night-eighties .ace_indent-guide {\n  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAYAAACZgbYnAAAAEklEQVQImWPQ09NrYAgMjP4PAAtGAwchHMyAAAAAAElFTkSuQmCC) right repeat-y\n}\n\n.ace-tomorrow-night-eighties .ace_indent-guide-active {\n  background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAACCAYAAACZgbYnAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAAZSURBVHjaYvj///9/hivKyv8BAAAA//8DACLqBhbvk+/eAAAAAElFTkSuQmCC") right repeat-y;\n}\n'}),define("ace/theme/tomorrow_night_eighties",["require","exports","module","ace/theme/tomorrow_night_eighties.css","ace/lib/dom"],function(e,t,n){t.isDark=!0,t.cssClass="ace-tomorrow-night-eighties",t.cssText=e("./tomorrow_night_eighties.css");var r=e("lib/dom");r.importCssString(t.cssText,t.cssClass,!1)});                (function() {
                    window.require(["ace/theme/tomorrow_night_eighties"], function(m) {
                        if (typeof module == "object" && typeof exports == "object" && module) {
                            module.exports = m;
                        }
                    });
                })();
            