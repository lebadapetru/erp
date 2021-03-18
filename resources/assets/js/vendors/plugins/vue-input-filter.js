import isEqual from 'lodash/isEqual'

const events = [
  "input",
  "keydown",
  "keyup",
  "mousedown",
  "mouseup",
  "select",
  "contextmenu",
  "drop"
];

const UNIQUE_ID = "__vue_input_filter__";

const onMounted = (el, binding, vnode) => {
  onUnmounted(el);
  let vm = vnode.context;
  let callback = binding.value.callback;

  el[UNIQUE_ID] = (event) => {
    if (inputFilter(this.value)) {
      this.oldValue = this.value;
      this.oldSelectionStart = this.selectionStart;
      this.oldSelectionEnd = this.selectionEnd;
    } else if (this.hasOwnProperty("oldValue")) {
      this.value = this.oldValue;
      this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
    } else {
      this.value = "";
    }

    return callback.call(vm, event);
  };

  document.addEventListener(clickEventType, el[UNIQUE_ID], false);
};

const onUnmounted = (el) => {
  document.removeEventListener(clickEventType, el[UNIQUE_ID], false);
  delete el[UNIQUE_ID];
};

const onUpdated = (el, binding, vnode) => {
  if (isEqual(binding.value, binding.oldValue)) {
    return;
  }
  onMounted(el, binding.value, vnode);
};

const plugin = {
  install: (app) => {
    app.directive('click-away', directive)
  }
}

const directive = {
  mounted: onMounted,
  updated: onUpdated,
  unmounted: onUnmounted,
};

const mixin = {
  directives: { ClickAway: directive },
};

export {
  directive,
  mixin
}

export default plugin;