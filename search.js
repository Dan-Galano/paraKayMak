const capstones = [
    { title: "Capstone Project 1", abstract: "This is the abstract for Capstone Project 1." },
    { title: "Capstone Project 2", abstract: "Abstract for the second capstone project." },
    // Add more capstones as needed
    ];

    function searchCapstone() {
    const searchTerm = document.getElementById("searchTitle").value.toLowerCase();
    const searchResults = [];

    // Iterate through capstones and find matches
    capstones.forEach(capstone => {
        const titleWords = capstone.title.toLowerCase().split(' ');
        if (titleWords.some(word => word.includes(searchTerm))) {
        searchResults.push(capstone);
        }
    });

    displayResults(searchResults);
    }

    function displayResults(results) {
    const resultsContainer = document.getElementById("searchResults");
    resultsContainer.innerHTML = "";

    results.forEach(result => {
        const resultElement = document.createElement("div");
        const boldedTitle = result.title.replace(new RegExp(`(${document.getElementById("searchTitle").value})`, 'gi'), '<strong>$1</strong>');
        resultElement.innerHTML = `<h3>${boldedTitle}</h3><p>${result.abstract}</p>`;
        resultsContainer.appendChild(resultElement);
    });
    }