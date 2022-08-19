const translations = {
    'search_result_0_prefix': 'Nalezeno',
    'search_result_0_suffix': 'výsledků.',
    'search_result_1_prefix': 'Nalezen',
    'search_result_1_suffix': 'výsledek.',
    'search_result_2_prefix': 'Nalezeny',
    'search_result_2_suffix': 'výsledky.',
    'search_result_3_prefix': 'Nalezeny',
    'search_result_3_suffix': 'výsledky.',
    'search_result_4_prefix': 'Nalezeny',
    'search_result_4_suffix': 'výsledky.',
    'search_result_5_and_more_prefix': 'Nalezeno',
    'search_result_5_and_more_suffix': 'výsledků.',
};

function findElement(selector) {
    'use strict';

    return document.querySelector(selector);
}

function hideElement(elem) {
    'use strict';

    elem.style.display = 'none';
}

function translate(subject) {
    'use strict';

    if (translations.hasOwnProperty(subject) === true) {
        return translations[subject];
    }

    throw new Error('Translation key: ' + subject + ' was not found.');
}

function goThroughWords(searchIndex, query, words) {
    'use strict';

    let searchResultItems = [];
    for (const word of words) {
        const expression = word.toLowerCase();
        const bands = searchIndex[expression];
        const items = goThroughBands(searchIndex, query, expression, bands);
        searchResultItems = searchResultItems.concat(items);
    }

    return searchResultItems;
}

function goThroughBands(searchIndex, query, word, bands) {
    'use strict';

    let searchResultItems = [];
    for (const band in bands) {
        const discs = searchIndex[word][band];
        const items = goThroughDiscs(searchIndex, query, word, band, discs);
        searchResultItems = searchResultItems.concat(items);
    }

    return searchResultItems;
}

function goThroughDiscs(searchIndex, query, word, band, discs) {
    'use strict';

    let searchResultItems = [];
    for (const disc in discs) {
        const songs = searchIndex[word][band][disc];
        const items = goThroughSongs(searchIndex, query, word, band, disc, songs);
        searchResultItems = searchResultItems.concat(items);
    }

    return searchResultItems;
}

function goThroughSongs(searchIndex, query, word, band, disc, songs) {
    'use strict';

    let searchResultItems = [];
    for (const song in songs) {
        const paths = searchIndex[word][band][disc][song];
        const path = paths[0];
        const item = {
            band: band,
            disc: disc,
            song: song,
            path: path + '?q=' + query
        };
        searchResultItems = searchResultItems.concat(item);
    }

    return searchResultItems;
}

function showSearchResultsIfTheUserIsSearching() {
    'use strict';

    const path = location.pathname;
    const q = location.search;

    if (path === '/' && q.startsWith('?q=')) {
        const homePageWrapper = findElement('.home-page-wrapper');
        hideElement(homePageWrapper);
        const query = q.substring(3);
        const queryDecoded = decodeURIComponent(query);
        const searchFieldElem = findElement('.js-search-form-search-field');
        searchFieldElem.value = queryDecoded;
        const words = queryDecoded.split(' ');
        const searchResult = goThroughWords(searchIndex, queryDecoded, words);
        const searchResultsWrapper = findElement('.search-results-wrapper');
        const searchResultInfo = document.createElement('p');
        const count = searchResult.length;

        if (count === 0) {
            const infoPrefix = translate('search_result_0_prefix');
            const infoSuffix = translate('search_result_0_suffix');
            searchResultInfo.textContent = infoPrefix + ' ' + count + ' ' + infoSuffix;
            searchResultInfo.className = 'search-info';
            searchResultsWrapper.appendChild(searchResultInfo);
        } else if (count === 1) {
            const infoPrefix = translate('search_result_1_prefix');
            const infoSuffix = translate('search_result_1_suffix');
            searchResultInfo.textContent = infoPrefix + ' ' + count + ' ' + infoSuffix;
            searchResultInfo.className = 'search-info';
            searchResultsWrapper.appendChild(searchResultInfo);
        } else if (count >= 2 && count <= 4) {
            const infoPrefix = translate('search_result_' + count + '_prefix');
            const infoSuffix = translate('search_result_' + count + '_suffix');
            searchResultInfo.textContent = infoPrefix + ' ' + count + ' ' + infoSuffix;
            searchResultInfo.className = 'search-info';
            searchResultsWrapper.appendChild(searchResultInfo);
        } else {
            const infoPrefix = translate('search_result_5_and_more_prefix');
            const infoSuffix = translate('search_result_5_and_more_suffix');
            searchResultInfo.textContent = infoPrefix + ' ' + count + ' ' + infoSuffix;
            searchResultInfo.className = 'search-info';
            searchResultsWrapper.appendChild(searchResultInfo);
        }

        let bandInProgress = '';
        let discInProgress = '';

        let createSongList = false;
        let songList = document.createElement('div');

        for (const item of searchResult) {
            if (item.band !== bandInProgress) {
                const h2 = document.createElement('h2');
                h2.textContent = item.band;
                searchResultsWrapper.appendChild(h2);
                bandInProgress = item.band;
                createSongList = false;
            }
            if (item.disc !== discInProgress) {
                const h3 = document.createElement('h3');
                h3.textContent = item.disc;
                searchResultsWrapper.appendChild(h3);
                discInProgress = item.disc;
                createSongList = true;
            }
            if (createSongList === true) {
                songList = document.createElement('div');
                songList.className = 'songs-list';
                searchResultsWrapper.appendChild(songList);
                createSongList = false;
            }
            const p = document.createElement('p');
            songList.appendChild(p);
            const a = document.createElement('a');
            a.href = item.path;
            a.textContent = item.song;
            p.appendChild(a);
        }
    }
}

function sendSearchFormOnSubmit() {
    'use strict';

    const submitButton = document.querySelector('.js-search-submit');

    function send(e) {
        e.preventDefault();

        const textField = submitButton
            .parentElement
            .parentElement
            .parentElement
            .getElementsByTagName('input')[0];

        const querySpaced = textField.value.replace(/(\W|\s)+/g, ' ');

        location.href = '/?q=' + querySpaced;
    }

    submitButton.addEventListener('click', send, false);
}

function switchToWhite() {
    const root = findElement('html');
    root.className = 'website-theme-white';
    const cookieName = 'theme';
    const theme = 'white';
    document.cookie = cookieName + '=' + theme + '; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT';
}

function switchToBlack() {
    const root = findElement('html');
    root.className = 'website-theme-black';
    const cookieName = 'theme';
    const theme = 'black';
    document.cookie = cookieName + '=' + theme + '; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT';
}

function switchThemeOnClick() {
    const cookieName = 'theme';
    const index = document.cookie.indexOf(cookieName);

    let theme = null;

    if (index !== -1) {
        const str = document.cookie.substr(index + cookieName.length + 1);

        if (str.indexOf('white') !== -1) {
            theme = 'white';
        }
        if (str.indexOf('black') !== -1) {
            theme = 'black';
        }
    }

    if (theme === null) {
        theme = 'white';
    }

    if (theme === 'white') {
        const root = findElement('html');
        root.className = 'website-theme-white';
    }

    if (theme === 'black') {
        const root = findElement('html');
        root.className = 'website-theme-black';
    }

    document.cookie = cookieName + '=' + theme + '; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT';

    const whiteThemeButton = findElement('.js-theme-white');
    whiteThemeButton.addEventListener('click', switchToWhite, false);

    const blackThemeButton = findElement('.js-theme-black');
    blackThemeButton.addEventListener('click', switchToBlack, false);
}

function markWords() {
    'use strict';

    const q = location.search;

    if (q.startsWith('?q=')) {
        const query = q.substring(3);
        const queryDecoded = decodeURIComponent(query);
        const words = queryDecoded.split(' ');
        const songWrapper = document.querySelector('.js-song-text');
        if (songWrapper !== null) {
            for (const word of words) {
                songWrapper.innerHTML = songWrapper.innerHTML.replace(
                    new RegExp(word, 'gi'),
                    '<span class="highlighting">$&</span>'
                );
            }
        }
    }
}

(function() {
    'use strict';

    showSearchResultsIfTheUserIsSearching();
    sendSearchFormOnSubmit();
    switchThemeOnClick();
    markWords();
})();
