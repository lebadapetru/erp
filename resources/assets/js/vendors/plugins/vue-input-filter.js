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

const onMounted = (el, binding) => {
  //onUnmounted(el);
  let callback = binding.value;

  el[UNIQUE_ID] = (event) => {
    console.log('listener')
    console.log(event)
  };

  events.forEach((event) => {
    document.addEventListener(event, el[UNIQUE_ID], false);
  })
};

const onUnmounted = (el) => {
  events.forEach((event) => {
    document.removeEventListener(event, el[UNIQUE_ID], false);
  })
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
    app.directive('input-filter', directive)
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