function rollDice() {
    const diceCount = document.getElementById('diceCount').value;
    const results = [];

    for (let i = 0; i < diceCount; i++) {
        const roll = Math.floor(Math.random() * 6) + 1;
        results.push(roll);
    }

    const rollResults = document.getElementById('rollResults');
    rollResults.innerHTML = '';

    results.forEach(result => {
        const img = document.createElement('img');
        img.src = `images/dice/${result}.png`;
        img.alt = `Wynik rzutu: ${result}`;
        img.style.width = '50px'; 
        img.style.margin = '5px'; 
        rollResults.appendChild(img);
    });
}
