!function(t){"use strict";function i(){}i.prototype.init=function(){t("#inline-editable").Tabledit({inputClass:"form-control form-control-sm",editButton:!1,deleteButton:!1,columns:{identifier:[0,"id"],editable:[[1,"col1"],[2,"col2"],[3,"col3"],[4,"col4"],[6,"col6"]]}}),t("#btn-editable").Tabledit({buttons:{edit:{class:"btn btn-primary",html:'<i class="mdi mdi-pencil"></i>',action:"edit"}},inputClass:"form-control form-control-sm",deleteButton:!1,saveButton:!1,autoFocus:!1,columns:{identifier:[0,"id"],editable:[[1,"col1"],[2,"col2"],[3,"col3"],[4,"col4"],[6,"col6"]]}})},t.EditableTable=new i,t.EditableTable.Constructor=i}(window.jQuery),function(){"use strict";window.jQuery.EditableTable.init()}();