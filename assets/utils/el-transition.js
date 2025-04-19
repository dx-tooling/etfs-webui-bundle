/*
    MIT License

    Copyright (c) 2020 Mike McCall

    https://github.com/mmccall10/el-transition/tree/master

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
 */
export async function enter(element, transitionName = null) {
    element.removeAttribute("hidden");
    await transition("enter", element, transitionName);
}

export async function leave(element, transitionName = null) {
    await transition("leave", element, transitionName);
    element.setAttribute("hidden", true);
}

export async function toggle(element, transitionName = null) {
    if (element.classList.contains("hidden")) {
        await enter(element, transitionName);
    } else {
        await leave(element, transitionName);
    }
}

async function transition(direction, element, animation) {
    const dataset = element.dataset;
    const animationClass = animation ? `${animation}-${direction}` : direction;
    let transition = `transition${direction.charAt(0).toUpperCase() + direction.slice(1)}`;
    const genesis = dataset[transition] ? dataset[transition].split(" ") : [animationClass];
    const start = dataset[`${transition}Start`]
        ? dataset[`${transition}Start`].split(" ")
        : [`${animationClass}-start`];
    const end = dataset[`${transition}End`] ? dataset[`${transition}End`].split(" ") : [`${animationClass}-end`];

    addClasses(element, genesis);
    addClasses(element, start);
    await nextFrame();
    removeClasses(element, start);
    addClasses(element, end);
    await afterTransition(element);
    removeClasses(element, end);
    removeClasses(element, genesis);
}

function addClasses(element, classes) {
    element.classList.add(...classes);
}

function removeClasses(element, classes) {
    element.classList.remove(...classes);
}

function nextFrame() {
    return new Promise((resolve) => {
        requestAnimationFrame(() => {
            requestAnimationFrame(resolve);
        });
    });
}

function afterTransition(element) {
    return Promise.all(element.getAnimations().map((animation) => animation.finished));
}
