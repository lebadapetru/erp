import isEqual from 'lodash/isEqual'

const clickEventType = document.ontouchstart !== null ? "click" : "touchstart";

const UNIQUE_ID = "__vue_click_away__";

const onMounted = (el, binding, vnode) => {
  onUnmounted(el);
  let vm = vnode.context;
  let callback = binding.value.callback;

  let nextTick = true;
  setTimeout(function () {
    nextTick = true;
  }, 0);

  function isVisible(elem) {
    if (!(elem instanceof Element)) throw Error('DomUtil: elem is not an element.');
    const style = getComputedStyle(elem);
    if (style.display === 'none') return false;
    if (style.visibility !== 'visible') return false;
    if (style.opacity < 0.1) return false;
    if (elem.offsetWidth + elem.offsetHeight + elem.getBoundingClientRect().height +
      elem.getBoundingClientRect().width === 0) {
      return false;
    }
    const elemCenter   = {
      x: elem.getBoundingClientRect().left + elem.offsetWidth / 2,
      y: elem.getBoundingClientRect().top + elem.offsetHeight / 2
    };
    if (elemCenter.x < 0) return false;
    if (elemCenter.x > (document.documentElement.clientWidth || window.innerWidth)) return false;
    if (elemCenter.y < 0) return false;
    if (elemCenter.y > (document.documentElement.clientHeight || window.innerHeight)) return false;
    let pointContainer = document.elementFromPoint(elemCenter.x, elemCenter.y);
    do {
      if (pointContainer === elem) return true;
    } while (pointContainer = pointContainer.parentNode);
    return false;
  }

  el[UNIQUE_ID] = (event) => {
    if (
      (!el || !el.contains(event.target)) &&
      isVisible(el) &&
      ('#'+event.target?.id !== binding.value?.trigger) &&
      callback &&
      nextTick &&
      typeof callback === "function"
    ) {
      return callback.call(vm, event);
    }
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