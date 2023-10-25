import Tagify from '@yaireo/tagify'
import '@yaireo/tagify/dist/tagify.css';

function tagTemplate(tagData) {
    return `
    <tag title="${tagData.email}"
    contenteditable='false'
    spellcheck='false'
    tabIndex="-1"
    class="tagify__tag ${tagData.class ? tagData.class : ""}"
    ${this.getAttributes(tagData)}>
<x title='' class='tagify_tag_removeBtn' role='button' aria-label='remove tag'></x>
<div>
<span class='tagify__tag-text'>${tagData.name}</span>
</div>
</tag>
`
}

function suggestionItemTemplate(tagData) {
    return `
    <div ${this.getAttributes(tagData)}
    class='tagify_dropdown_item ${tagData.class ? tagData.class : ""}'
    tabindex="0"
    role="option">
    <strong>${tagData.name}</strong>
</div>
`
}

// initialize Tagify on the above input node reference
if (inputElm.length) {
    inputElm.forEach(function (element) {
        let tagify = new Tagify(element, {
            tagTextProp: 'name', // very important since a custom template is used with this property as text
            enforceWhitelist: true,
            skipInvalid: true, // do not remporarily add invalid tags
            dropdown: {
                closeOnSelect: false,
                enabled: 0,
                classname: 'roles-list',
                searchKeys: ['name']  // very important to set by which keys to search for suggestions when typing
            },
            whitelist: tagifyData,
        })

        // qui prende i selezionati
        tagify.addTags(tagifyDataSelected);

    })
} else {
    let tagify = new Tagify(inputElm, {
        tagTextProp: 'name', // very important since a custom template is used with this property as text
        enforceWhitelist: true,
        skipInvalid: true, // do not remporarily add invalid tags
        dropdown: {
            closeOnSelect: false,
            enabled: 0,
            classname: 'roles-list',
            searchKeys: ['name']  // very important to set by which keys to search for suggestions when typing
        },
        whitelist: tagifyData,
    })

    // qui prende i selezionati
    tagify.addTags(tagifyDataSelected);

    // attach events listeners
    tagify.on('dropdown:select', onSelectSuggestion) // allows selecting all the suggested (whitelist) items
        .on('edit:start', onEditStart)  // show custom text in the tag while in edit-mode


    function onSelectSuggestion(e) {
        if (e.detail.event.target.matches('.remove-all-tags')) {
            tagify.removeAllTags()
        }

        // custom class from "dropdownHeaderTemplate"
        else if (e.detail.elm.classList.contains(`${tagify.settings.classNames.dropdownItem}__addAll`))
            tagify.dropdown.selectAll();
    }

    function onEditStart({detail: {tag, data}}) {
        tagify.setTagTextNode(tag, `${data.name}`)
    }
}
