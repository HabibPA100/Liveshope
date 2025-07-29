document.addEventListener('alpine:init', () => {
            Alpine.store('cart', {
                items: JSON.parse(localStorage.getItem('cart') || '[]'),

                save() {
                    localStorage.setItem('cart', JSON.stringify(this.items));
                },

                has(id) {
                    return this.items.some(i => i.id === id);
                },

                add(item) {
                    if (!this.has(item.id)) {
                        this.items.push(item);
                        this.save();
                    }
                },

                updateQty(id, amount) {
                    const item = this.items.find(i => i.id === id);
                    if (item) {
                        item.quantity = Math.max(1, item.quantity + amount);
                        this.save();
                    }
                },

                remove(id) {
                    this.items = this.items.filter(i => i.id !== id);
                    this.save();
                },

                clear() {
                    this.items = [];
                    this.save();
                },

                total() {
                    return this.items.reduce((sum, i) => sum + i.price * i.quantity, 0);
                }
            });
        });